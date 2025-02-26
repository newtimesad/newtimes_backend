<?php

use backend\assets\AdminLtePluginAsset;
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

<div class="container h-100 w-100">
    <div class="row h-100 justify-content-center align-items-center" style="margin-top: 30%">
        <div class="col-sm-11 col-md-4 col-lg-4 col-xl-4 text-center">
            <div class="card bg-dark">
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
                                    ['tabindex' => '5', 'style'=>"color: orange"]
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
                        ['/user/registration/resend'],
                        ['style'=>"color: orange"]
                    ) ?>
                </p>
            <?php endif ?>
            <?php if ($module->enableRegistration): ?>
                <p class="text-center" style="color: white">
                    <?= Html::a(Yii::t('usuario', 'Don\'t have an account? Sign up!'), ['/user/registration/register'], ['style'=>"color: orange"]) ?>
                </p>
            <?php endif ?>
        </div>
    </div>
</div>
