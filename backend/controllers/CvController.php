<?php

namespace backend\controllers;

use yii\web\Controller;
use Yii;

class CvController extends Controller
{
    public function actionCv()
    {
        $cacheKey = 'cv_data';
        $cacheTtl = 3600; // 1 hour

        $cvData = Yii::$app->cache->getOrSet($cacheKey, function () {

            $filePath = Yii::getAlias('@common/data/cv.json');

            if (!file_exists($filePath)) {
                return [];
            }

            return json_decode(file_get_contents($filePath), true);
        }, $cacheTtl);

        return $this->render('cv', [
            'cvData' => $cvData,
        ]);
    }

    // ✅ Method 2: Clear only CV cache
    public function actionClearCvCache()
    {
        Yii::$app->cache->delete('cv_data');

        // optional: flash message
        Yii::$app->session->setFlash('success', 'CV cache cleared');

        return $this->redirect(['cv']);
    }
}
