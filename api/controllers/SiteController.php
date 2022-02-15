<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
//                'only' => ['api'],//List of actions to be applied
                'cors' =>
                    [
                        'Origin' => ['*'],
//                        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
////                        'Access-Control-Request-Headers' => ['*'],// Even you can filter by IP Address
//                        'Access-Control-Allow-Credentials' => true,
//                        'Access-Control-Max-Age' => 86400,
//                        'Access-Control-Expose-Headers' => []
                    ]
            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['confirm', 'confirm-new-email'],
//                'rules' => [
//                    [
//                        'actions' => ['confirm', 'confirm-new-email'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                ],
//            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


}
