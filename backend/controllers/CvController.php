<?php

namespace backend\controllers;

use yii\web\Controller;
use Yii;
use Mpdf\Mpdf;
use yii\web\Response;



class CvController extends Controller
{

    // Add this method to control who can access the CV
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['cv', 'download'], // Specify allowed actions
                        'roles' => ['?', '@'], // Allow guests and authenticated users
                    ],
                    // Add more rules as needed
                ],
            ],
        ];
    }


    public function actionCv()
    {
        $cacheKey = 'cv_data';
        $cacheTtl = 3600;

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


    public function actionDownload()
    {
        // 1. Fetch CV data (reuse cache)
        $cvData = Yii::$app->cache->get('cv_data');

        if ($cvData === false) {
            $filePath = Yii::getAlias('@common/data/cv.json');
            $cvData = file_exists($filePath)
                ? json_decode(file_get_contents($filePath), true)
                : [];

            Yii::$app->cache->set('cv_data', $cvData);
        }

        // 2. Render PDF-specific view into HTML
        $html = $this->renderPartial('cv-pdf', [
            'cvData' => $cvData,
        ]);

        // 3. Generate PDF
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
        ]);

        $mpdf->WriteHTML($html);

        // 🔥 4. Yii-controlled response (THIS FIXES THE TEST)
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set(
            'Content-Disposition',
            'attachment; filename="cv.pdf"'
        );

        return $mpdf->Output('', 'S'); // return PDF as string
    }
}
