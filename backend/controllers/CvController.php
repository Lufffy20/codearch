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
    CvTemplate
};
use common\services\CvService;

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
            'socials'
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
            'socials'
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
            return $this->redirect(['cv', 'id' => $cv->id, 'template' => 1]);
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
        $relations = ['personalDetails', 'educations', 'experiences', 'skills', 'socials'];
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
        $educations  = $cvId ? Education::findAll(['cv_id' => $cvId]) : [];
        $experiences = $cvId ? Experience::findAll(['cv_id' => $cvId]) : [];
        $skills      = $cvId ? Skill::findAll(['cv_id' => $cvId]) : [];
        $socials     = $cvId ? Social::findAll(['cv_id' => $cvId]) : [];

        return [
            'educations'  => $this->withAtLeastOne($educations, Education::class),
            'experiences' => $this->withAtLeastOne($experiences, Experience::class),
            'skills'      => $this->withAtLeastOne($skills, Skill::class),
            'socials'     => $this->withAtLeastOne($socials, Social::class),
        ];
    }

    private function withAtLeastOne(array $models, string $class)
    {
        return empty($models) ? [new $class()] : $models;
    }


    private function downloadPdf(string $html, string $filename)
    {
        $mpdf = new Mpdf([
            'format'        => 'A4',
            'margin_top'    => 10,
            'margin_bottom' => 10,
            'tempDir'       => Yii::getAlias('@runtime/mpdf'),
        ]);

        $mpdf->WriteHTML($html);
        return $mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
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
