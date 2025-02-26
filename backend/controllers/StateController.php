<?php

namespace backend\controllers;

use Da\User\Validator\AjaxRequestModelValidator;
use Yii;
use common\models\State;
use common\models\StateSearch;
use yii\bootstrap4\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StateController implements the CRUD actions for State model.
 */
class StateController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all State models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'default' => SORT_ASC
                ]
            ]
        ]);
        $dataProvider->query->orderBy(['id' => SORT_ASC]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single State model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new State model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new State();

        $post = Yii::$app->request->post();
        $validator = new AjaxRequestModelValidator($model);
        if(isset($post['ajax']) && !$validator->validate()){
            return ActiveForm::validate($model);
        }

        if ($model->load($post) && $model->save()) {
            return $this->asJson([
                'success' => true
            ]);
        }elseif ($model->hasErrors()){
            return $this->asJson([
                'success' => false,
                'errors' => $model->errors
            ]);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing State model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        $validator = new AjaxRequestModelValidator($model);
        if(isset($post['ajax']) && !$validator->validate()){
            return ActiveForm::validate($model);
        }

        if ($model->load($post) && $model->save()) {
            return $this->asJson([
                'success' => true
            ]);
        }elseif ($model->hasErrors()){
            return $this->asJson([
                'success' => false,
                'errors' => $model->errors
            ]);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing State model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the State model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return State the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = State::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
