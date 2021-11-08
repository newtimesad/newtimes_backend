<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BusinessProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Business Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-profile-index">



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.profile.name',
            'name',
            'gender',
            'age',
//            'ethnicity',
//            'hair_color',
//            'eye_color',
//            'height',
//            'measurements',
//            'affiliation',
//            'available_to',
//            'aviability',
            [
                    'attribute' => 'city.name',
                'label' => 'City'
            ],
            [
                'attribute' => 'kyc.status',
                'label' => 'Status'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
