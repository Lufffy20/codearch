<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Mpdf\Mpdf;
use common\models\{
    Cv,
    PersonalDetails,
    Education,
    Experience,
    Skill,
    Social,
    CvTemplate,
    Project,
    Achievement,
    Language,
    Award,
    Course
};
use common\services\CvService;
use yii\web\UploadedFile;
use common\models\CvImage;

class CvController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /* ================= INDEX ================= */

    public function actionIndex()
    {
        $cvs = Cv::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('index', compact('cvs'));
    }

    /* ================= VIEW / PREVIEW ================= */

    public function actionCv($id)
    {
        $cv = $this->findUserCv($id);
        $forceTemplate = (bool) Yii::$app->request->get('template');

        if ($cv->shouldUseTemplate($forceTemplate)) {
            $rendered = $cv->renderWithTemplate();

            return $this->render('cv-template', [
                'html' => $rendered['html'],
                'css'  => $rendered['css'],
                'cvId' => $cv->id,
            ]);
        }

        return $this->render('cv', [
            'cvData' => $cv->getCvData(),
            'cvId'   => $cv->id,
        ]);
    }

    /* ================= DOWNLOAD ================= */

    public function actionDownload($id)
    {
        $cv = $this->findUserCv($id);

        $templateId = Yii::$app->request->get('template_id');

        if ($templateId) {

            // 🔹 TEMPORARY template render (no DB save)
            $html = $cv->renderWithTemplate($templateId)['html'];
        } else {

            // 🔹 Default CV PDF
            $html = $this->renderPartial('cv-pdf', [
                'cvData' => $cv->getCvData(),
            ]);
        }

        return $this->downloadPdf($html, 'cv_' . $cv->id . '.pdf');
    }


    /* ================= CREATE ================= */

    public function actionCreate()
    {
        $cv = new Cv([
            'user_id'     => Yii::$app->user->id,
            'template_id' => CvTemplate::find()
                ->select('id')
                ->where(['is_active' => true])
                ->orderBy(['id' => SORT_ASC])
                ->scalar(),
        ]);

        $personal  = new PersonalDetails();
        $templates = CvTemplate::getActiveTemplates();
        extract($this->getFormCollections());

        if (
            $cv->load(Yii::$app->request->post()) &&
            $personal->load(Yii::$app->request->post()) &&
            CvService::saveCv($cv, $personal, Yii::$app->request->post())
        ) {

            /* ================= PROFILE IMAGE UPLOAD ================= */

            $image = UploadedFile::getInstanceByName('profile_image');
            CvImage::handleProfileImageUpload($cv->id, $image);

            /* ================= END IMAGE ================= */

            Yii::$app->session->setFlash('success', 'CV created successfully 🎉');
            return $this->redirect(['templates', 'id' => $cv->id]);
        }

        return $this->render('create', compact(
            'cv',
            'personal',
            'templates',
            'educations',
            'experiences',
            'skills',
            'socials',
            'projects',
            'achievements',
            'languages',
            'awards',
            'courses'
        ));
    }

    /* ================= UPDATE ================= */

    public function actionUpdate($id)
    {
        $cv = $this->findUserCv($id, false);

        $personal = PersonalDetails::findOne(['cv_id' => $cv->id])
            ?? new PersonalDetails(['cv_id' => $cv->id]);

        $templates = CvTemplate::getActiveTemplates();
        extract($this->getFormCollections($cv->id));

        if (
            $cv->load(Yii::$app->request->post()) &&
            $personal->load(Yii::$app->request->post()) &&
            CvService::saveCv($cv, $personal, Yii::$app->request->post(), true)
        ) {

            /* ================= PROFILE IMAGE LOGIC ================= */

            $image  = UploadedFile::getInstanceByName('profile_image');
            $remove = Yii::$app->request->post('remove_profile_image');

            // Remove image if requested
            if ($remove) {
                CvImage::removeProfileImage($cv->id);
            }

            // Upload new image if provided
            if ($image) {
                CvImage::handleProfileImageUpload($cv->id, $image);
            }

            /* ================= END IMAGE ================= */

            Yii::$app->session->setFlash('success', 'CV updated successfully 🎉');
            return $this->refresh();
        }

        return $this->render('update', compact(
            'cv',
            'personal',
            'templates',
            'educations',
            'experiences',
            'skills',
            'socials',

            // ✅ NEW
            'projects',
            'achievements',
            'languages',
            'awards',
            'courses'
        ));
    }



    /* ================= TEMPLATE SELECT ================= */

    public function actionTemplates($id)
    {
        $cv = $this->findUserCv($id, false);
        $templates = CvTemplate::getActiveTemplates();

        if ($templateId = Yii::$app->request->post('template_id')) {

            if (!CvTemplate::find()->where(['id' => $templateId, 'is_active' => true])->exists()) {
                throw new NotFoundHttpException('Invalid template');
            }

            $cv->updateAttributes(['template_id' => $templateId]);
            Yii::$app->session->setFlash('success', 'Template updated successfully!');
            return $this->redirect(['templates', 'id' => $cv->id]);
        }

        return $this->render('templates', compact('cv', 'templates'));
    }

    /* ================= PREVIEW ================= */

    public function actionPreview($id, $template_id)
    {
        $cv = $this->findUserCv($id, false);

        $originalTemplate = $cv->template_id;
        $cv->template_id = $template_id;

        $rendered = $cv->renderWithTemplate();
        $cv->template_id = $originalTemplate;

        return $this->renderAjax('_template_preview', [
            'html' => $rendered['html'],
            'css'  => $rendered['css'],
        ]);
    }

    /* ================= DELETE ================= */

    public function actionDelete($id)
    {
        $cv = $this->findUserCv($id, false);
        $cv->delete();

        Yii::$app->session->setFlash('success', 'CV deleted successfully 🗑️');
        return $this->redirect(['index']);
    }

    /* ================= HELPERS ================= */

    private function findUserCv($id, bool $withTemplate = true): Cv
    {
        $relations = [
            'personalDetails',
            'educations',
            'experiences',
            'skills',
            'socials',
            'projects',
            'achievements',
            'languages',
            'awards',
            'courses',
        ];

        if ($withTemplate) {
            $relations[] = 'template';
        }

        $cv = Cv::find()
            ->with($relations)
            ->where(['id' => $id, 'user_id' => Yii::$app->user->id])
            ->one();

        if (!$cv) {
            throw new NotFoundHttpException('CV not found');
        }

        return $cv;
    }

    private function getFormCollections(?int $cvId = null): array
    {
        $educations   = $cvId ? Education::findAll(['cv_id' => $cvId]) : [];
        $experiences  = $cvId ? Experience::findAll(['cv_id' => $cvId]) : [];
        $skills       = $cvId ? Skill::findAll(['cv_id' => $cvId]) : [];
        $socials      = $cvId ? Social::findAll(['cv_id' => $cvId]) : [];

        $projects     = $cvId ? Project::findAll(['cv_id' => $cvId]) : [];
        $achievements = $cvId ? Achievement::findAll(['cv_id' => $cvId]) : [];
        $languages    = $cvId ? Language::findAll(['cv_id' => $cvId]) : [];
        $awards       = $cvId ? Award::findAll(['cv_id' => $cvId]) : [];
        $courses      = $cvId ? Course::findAll(['cv_id' => $cvId]) : [];

        return [
            'educations'   => $this->withAtLeastOne($educations, Education::class),
            'experiences'  => $this->withAtLeastOne($experiences, Experience::class),
            'skills'       => $this->withAtLeastOne($skills, Skill::class),
            'socials'      => $this->withAtLeastOne($socials, Social::class),

            'projects'     => $this->withAtLeastOne($projects, Project::class),
            'achievements' => $this->withAtLeastOne($achievements, Achievement::class),
            'languages'    => $this->withAtLeastOne($languages, Language::class),
            'awards'       => $this->withAtLeastOne($awards, Award::class),
            'courses'      => $this->withAtLeastOne($courses, Course::class),
        ];
    }


    private function withAtLeastOne(array $models, string $class)
    {
        return empty($models) ? [new $class()] : $models;
    }


    private function downloadPdf(string $html, string $filename)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode'           => 'utf-8',
            'format'         => 'A4',
            'margin_top'     => 10,
            'margin_bottom'  => 10,
            'margin_left'    => 10,
            'margin_right'   => 10,
            'tempDir'        => Yii::getAlias('@runtime/mpdf'),
            'default_font'   => 'dejavusans',
        ]);


        $mpdf->WriteHTML($html);
        return $mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
    }

    /* ================= IMPORT ================= */

    public function actionImport()
    {
        $cv = new Cv([
            'user_id' => Yii::$app->user->id,
            'template_id' => CvTemplate::find()
                ->select('id')
                ->where(['is_active' => true])
                ->orderBy(['id' => SORT_ASC])
                ->scalar(),
        ]);

        $templates = CvTemplate::getActiveTemplates();

        if (Yii::$app->request->isPost) {

            $file = UploadedFile::getInstanceByName('resume_file');

            if ($file && $file->error === UPLOAD_ERR_OK) {
                try {
                    $import = \common\services\ResumeImportService::import($file);

                    $cv->title = $import['cv']->title;
                    $personal  = $import['personal'];

                    return $this->render('create', array_merge(
                        $import,
                        compact('cv', 'templates')
                    ));
                } catch (\Throwable $e) {
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            } else {
                Yii::$app->session->setFlash('error', 'Invalid resume file.');
            }
        }

        return $this->render('import', compact('cv', 'templates'));
    }


    /* ================= THUMBNAIL ================= */

    public function actionThumbnail($id, $template_id)
    {
        $cv = $this->findUserCv($id, false);

        // temporary template switch (FlowCV style)
        $originalTemplate = $cv->template_id;
        $cv->template_id = $template_id;

        $rendered = $cv->renderWithTemplate();

        // restore original template
        $cv->template_id = $originalTemplate;

        return $this->renderPartial('_template_thumbnail', [
            'html' => $rendered['html'],
            'css'  => $rendered['css'],
        ]);
    }
}
