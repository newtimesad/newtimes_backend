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
use Da\User\Widget\ConnectWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \Da\User\Form\LoginForm $model
 * @var \Da\User\Module $module
 */

AdminLtePluginAsset::register($this);

$this->title = Yii::t('usuario', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/shared/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="h-100">
    <div class="row justify-content-center align-self-center">
        <div class="col-sm-11 col-md-4 col-lg-4 col-xl-4">
            <div class="card" style="background-color: black">
                <div class="card-header">
                    <h3 class="card-title" style="color: white"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="card-body" style="color: white">
                    <?php $form = ActiveForm::begin(
                        [
                            'id' => $model->formName(),
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => false,
                            'validateOnBlur' => false,
                            'validateOnType' => false,
                            'validateOnChange' => false,
                        ]
                    ) ?>

                    <?= $form->field(
                        $model,
                        'login',
                        ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                    ) ?>

                    <?= $form
                        ->field(
                            $model,
                            'password',
                            ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']]
                        )
                        ->passwordInput()
                        ->label(
                            Yii::t('usuario', 'Password')
                            . ($module->allowPasswordRecovery ?
                                ' (' . Html::a(
                                    Yii::t('usuario', 'Forgot password?'),
                                    ['/user/recovery/request'],
                                    ['tabindex' => '5']
                                )
                                . ')' : '')
                        ) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

                    <?= Html::submitButton(
                        Yii::t('usuario', 'Sign in'),
                        ['class' => 'btn btn-primary btn-block', 'style' => 'background-color: orange','tabindex' => '3']
                    ) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <?php if ($module->enableEmailConfirmation): ?>
                <p class="text-center">
                    <?= Html::a(
                        Yii::t('usuario', 'Didn\'t receive confirmation message?'),
                        ['/user/registration/resend']
                    ) ?>
                </p>
            <?php endif ?>
            <?php if ($module->enableRegistration): ?>
                <p class="text-center" style="color: white">
                    <?= Html::a(Yii::t('usuario', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
                </p>
            <?php endif ?>

        </div>
    </div>
</div>