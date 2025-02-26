<?php

use common\models\Location;
use common\models\Post;
use common\models\Service;
use common\models\SpecialityCategory;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'My Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">


    <?= Html::a(Yii::t('app', 'New Post'), ['create'], ['class' => 'btn btn-sm btn-success mb-3', 'style'=>"background-color: orange; border-color: orange;"]) ?>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'businessProfile.name',
            [
                'attribute' => 'type.name',
                'label' => 'Type'
            ],
            [
                'label' => "Locations",
                'format' => 'html',
                'value' => function ($model) {
                    /** @var Post $model */
                    return implode(' ', array_map(function ($location) {
                        /** @var \common\models\City $location */
                        return Html::tag("span", $location->name, ['class' => 'badge badge-secondary']);
                    }, $model->locations));
                }
            ],
            [
                'label' => "Services",
                'format' => 'html',
                'value' => function ($model) {
                    /** @var Post $model */
                    return implode(' ', array_map(function ($service) {
                        /** @var Service $service */
                        return Html::tag("span", $service->name, ['class' => 'badge badge-primary']);
                    }, $model->services));
                }
            ],
            [
                'label' => "Speciality Categories",
                'format' => 'html',
                'value' => function ($model) {
                    /** @var Post $model */
                    return implode(' ', array_map(function ($spc) {
                        /** @var SpecialityCategory $spc */
                        return Html::tag("span", $spc->name, ['class' => 'badge badge-info']);
                    }, $model->specialityCategories));
                }
            ],
            [
                'label' => 'Total Price',
                'value' => function ($model) {
                    return Yii::$app->formatter->asCurrency($model->price, 'usd');
                }
            ],
            [
                'attribute' => "status",
                'format' => 'html',
                'value' => function ($model) {
                    /** @var Post $model */
                    switch ($model->status) {
                        case $model::STATUS_ACCEPTED:
                            return Html::tag("span", ucfirst($model->status), ['class' => 'badge badge-success']);
                        case $model::STATUS_DECLINED:
                            return Html::tag("span", ucfirst($model->status), ['class' => 'badge badge-danger']);
                        default:
                            return Html::tag("span", ucfirst($model->status), ['class' => 'badge badge-secondary']);

                    }
                }
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update} {delete}",
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


</div>
