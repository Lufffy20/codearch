<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\LoginForm;

/**
 * SiteController
 * Handles authentication and basic site actions
 */
class SiteController extends Controller
{
    /**
     * Defines access rules and HTTP verb filters
     */
    public function behaviors()
    {
        return [
            // Access control configuration
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    // Allow guests to access login and error pages
                    [
                        'actions' => ['login', 'error'],
                        'allow'   => true,
                    ],
                    // Allow authenticated users to access index and logout
                    [
                        'actions' => ['logout', 'index'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],

            // HTTP verb restrictions
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    // Logout should only be accessible via POST
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller
     */
    public function actions()
    {
        return [
            // Default error handler
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays the dashboard / homepage
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Handles user login
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        // If user is already logged in, redirect to home
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // Use blank layout for login page
        $this->layout = 'blank';

        $model = new LoginForm();

        // Process login form submission
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        // Clear password field before rendering
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
