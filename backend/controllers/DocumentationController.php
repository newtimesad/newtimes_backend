<?php

namespace backend\controllers;

use common\models\SystemDocs;
use Da\User\Traits\ContainerAwareTrait;
use Da\User\Validator\AjaxRequestModelValidator;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class DocumentationController extends \yii\web\Controller
{
    use ContainerAwareTrait;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['manage'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['list'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionManage()
    {
        $documentation = SystemDocs::find()->one();
        if(!$documentation){
            $documentation = new SystemDocs();
        }

        $this->make(AjaxRequestModelValidator::class, [$documentation])->validate();

        if($documentation->load(Yii::$app->request->post()) and $documentation->save()){
            Yii::$app->session->setFlash('success', "Changes save successfully");

        }elseif($documentation->hasErrors()){
            Yii::$app->session->setFlash('danger', "An error occur while saving changes");
        }

        return $this->render('documentation', [
            'documentation' => $documentation
        ]);
    }

    public function actionList()
    {
        $this->layout = 'blank';
        return $this->render('list', [
            'documentation' => SystemDocs::find()->one()
        ]);
    }
}