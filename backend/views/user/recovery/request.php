<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use backend\assets\AdminLtePluginAsset;
use http\Url;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View               $this
 * @var yii\bootstrap4\ActiveForm     $form
 * @var \Da\User\Form\RecoveryForm $model
 */

$this->title = Yii::t('usuario', 'Recover your password');
//$this->params['breadcrumbs'][] = $this->title;

AdminLtePluginAsset::register($this);
?>
<div class="row justify-content-center">
    <div class="col-md-4 col-sm-6 align-self-center">
        <div class="card bg-dark">
            <div class="card-header">
                <h3 class="card-title">
                    <?= Html::encode($this->title) ?>
                </h3>
                <div class="float-right">
                    <?= Html::a(
                            FAS::icon(FAS::_LONG_ARROW_ALT_LEFT),
                        \yii\helpers\Url::to(['//user/login'])
                    ) ?>
                </div>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => $model->formName(),
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                    ]
                ); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= Html::submitButton(Yii::t('usuario', 'Continue'), ['class' => 'btn btn-warning btn-block']) ?><br>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
