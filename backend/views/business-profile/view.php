<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessProfile */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Business Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="business-profile-view">


    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div style="background-color: white">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
//                'id',
//                'user_id',
                'name',
                'gender',
                'age',
                'ethnicity',
                'hair_color',
                'eye_color',
                'height',
                'measurements',
                'affiliation',
                'available_to',
                'aviability',
                'city.name',
            ],
        ]) ?>
    </div>

</div>
