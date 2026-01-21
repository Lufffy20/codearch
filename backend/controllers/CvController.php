<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use Mpdf\Mpdf;

class CvController extends Controller
{
    /**
     * Access control configuration
     * Allows both guests (?) and authenticated users (@)
     * to access CV view and download actions
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow'   => true,
                        'actions'=> ['cv', 'download'],
                        'roles'  => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Display CV page
     * CV data is loaded from cache (or JSON file if cache miss)
     */
    public function actionCv()
    {
        $cacheKey = 'cv_data';
        $cacheTtl = 3600; // cache for 1 hour

        $cvData = Yii::$app->cache->getOrSet(
            $cacheKey,
            function () {
                $filePath = Yii::getAlias('@common/data/cv.json');

                // If CV file does not exist, return empty array
                if (!file_exists($filePath)) {
                    return [];
                }

                // Decode JSON CV data
                return json_decode(file_get_contents($filePath), true);
            },
            $cacheTtl
        );

        return $this->render('cv', [
            'cvData' => $cvData,
        ]);
    }

    /**
     * Clear only CV-related cache
     * Useful after updating cv.json
     */
    public function actionClearCvCache()
    {
        Yii::$app->cache->delete('cv_data');

        // Optional success message
        Yii::$app->session->setFlash('success', 'CV cache cleared');

        return $this->redirect(['cv']);
    }

    /**
     * Download CV as PDF
     * Uses cached CV data and mPDF for PDF generation
     */
    public function actionDownload()
    {
        // Fetch CV data from cache
        $cvData = Yii::$app->cache->get('cv_data');

        // If cache is empty, load data from JSON file
        if ($cvData === false) {
            $filePath = Yii::getAlias('@common/data/cv.json');

            $cvData = file_exists($filePath)
                ? json_decode(file_get_contents($filePath), true)
                : [];

            Yii::$app->cache->set('cv_data', $cvData);
        }

        // Render PDF-specific view as HTML
        $html = $this->renderPartial('cv-pdf', [
            'cvData' => $cvData,
        ]);

        // Initialize mPDF with basic configuration
        $mpdf = new Mpdf([
            'format'        => 'A4',
            'margin_top'    => 10,
            'margin_bottom' => 10,
        ]);

        // Write HTML content to PDF
        $mpdf->WriteHTML($html);

        // Prepare Yii response for PDF download
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set(
            'Content-Disposition',
            'attachment; filename="cv.pdf"'
        );

        // Return PDF output as string (important for tests)
        return $mpdf->Output('', 'S');
    }
}
