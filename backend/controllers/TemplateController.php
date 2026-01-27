<?php

namespace backend\controllers;

use Yii;
use common\models\CvTemplate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class TemplateController extends Controller
{
    public function actionIndex()
    {
        $templates = CvTemplate::find()
            ->orderBy(['sort_order' => SORT_ASC])
            ->all();

        return $this->render('index', compact('templates'));
    }

    public function actionCreate()
    {
        $model = new CvTemplate();

        if ($model->load(Yii::$app->request->post())) {

            // get uploaded image
            $model->thumbnailFile = UploadedFile::getInstance($model, 'thumbnailFile');

            if ($model->validate()) {

                if ($model->thumbnailFile) {
                    $fileName = 'template_' . time() . '.' . $model->thumbnailFile->extension;

                    $uploadPath = Yii::getAlias('@backend/web/images/templates/') . $fileName;
                    $model->thumbnailFile->saveAs($uploadPath);

                    $model->thumbnail_url = '/images/templates/' . $fileName;
                }

                $model->created_at = time();
                $model->updated_at = time();

                $model->save(false);

                Yii::$app->session->setFlash('success', 'Template added successfully');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id)
    {
        $model = CvTemplate::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Template not found');
        }

        $oldThumbnail = $model->thumbnail_url;

        if ($model->load(Yii::$app->request->post())) {

            $model->thumbnailFile = UploadedFile::getInstance($model, 'thumbnailFile');

            if ($model->validate()) {

                if ($model->thumbnailFile) {
                    $fileName = 'template_' . time() . '.' . $model->thumbnailFile->extension;

                    $uploadPath = Yii::getAlias('@backend/web/images/templates/') . $fileName;
                    $model->thumbnailFile->saveAs($uploadPath);

                    $model->thumbnail_url = '/images/templates/' . $fileName;
                } else {
                    // keep old image
                    $model->thumbnail_url = $oldThumbnail;
                }

                $model->updated_at = time();
                $model->save(false);

                Yii::$app->session->setFlash('success', 'Template updated successfully');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', compact('model'));
    }
}
