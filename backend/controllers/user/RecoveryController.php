<?php

namespace backend\controllers\user;

use Da\User\Event\FormEvent;
use Da\User\Event\ResetPasswordEvent;
use Da\User\Factory\MailFactory;
use Da\User\Form\RecoveryForm;
use Da\User\Model\Token;
use Da\User\Service\PasswordRecoveryService;
use Da\User\Service\ResetPasswordService;
use Da\User\Validator\AjaxRequestModelValidator;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;

class RecoveryController extends \Da\User\Controller\RecoveryController
{

    /**
     * Displays / handles user password recovery request.
     *
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     * @throws InvalidParamException
     * @return string
     *
     */
    public function actionRequest()
    {
        $this->layout = '@backend/views/layouts/blank.php';

        if (!$this->module->allowPasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var RecoveryForm $form */
        $form = $this->make(RecoveryForm::class, [], ['scenario' => RecoveryForm::SCENARIO_REQUEST]);

        $event = $this->make(FormEvent::class, [$form]);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->trigger(FormEvent::EVENT_BEFORE_REQUEST, $event);

            $mailService = MailFactory::makeRecoveryMailerService($form->email);

            if ($this->make(PasswordRecoveryService::class, [$form->email, $mailService])->run()) {
                $this->trigger(FormEvent::EVENT_AFTER_REQUEST, $event);
            }

            Yii::$app->session->setFlash('success', Yii::t('usuario', 'Recovery message sent'));

            return $this->redirect(['//user/login']);
        }

        return $this->render('request', ['model' => $form]);
    }

    /**
     * Displays / handles user password reset.
     *
     * @param $id
     * @param $code
     *
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     * @throws InvalidParamException
     * @return string
     *
     */
    public function actionReset($id, $code)
    {
        $this->layout = '@backend/views/layouts/blank.php';
        if (!$this->module->allowPasswordRecovery && !$this->module->allowAdminPasswordRecovery) {
            throw new NotFoundHttpException();
        }
        /** @var Token $token */
        $token = $this->tokenQuery->whereUserId($id)->whereCode($code)->whereIsRecoveryType()->one();
        /** @var ResetPasswordEvent $event */
        $event = $this->make(ResetPasswordEvent::class, [$token]);

        $this->trigger(ResetPasswordEvent::EVENT_BEFORE_TOKEN_VALIDATE, $event);

        if ($token === null || $token->getIsExpired() || $token->user === null) {
            Yii::$app->session->setFlash(
                'danger',
                Yii::t('usuario', 'Recovery link is invalid or expired. Please try requesting a new one.')
            );

//            return $this->render(
//                '/shared/message',
//                [
//                    'title' => Yii::t('usuario', 'Invalid or expired link'),
//                    'module' => $this->module,
//                ]
//            );
            return $this->redirect(['//user/login']);
        }

        /** @var RecoveryForm $form */
        $form = $this->make(RecoveryForm::class, [], ['scenario' => RecoveryForm::SCENARIO_RESET]);
        $event = $event->updateForm($form);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if ($form->load(Yii::$app->getRequest()->post())) {
            if ($this->make(ResetPasswordService::class, [$form->password, $token->user])->run()) {
                $this->trigger(ResetPasswordEvent::EVENT_AFTER_RESET, $event);

                Yii::$app->session->setFlash('success', Yii::t('usuario', 'Password has been changed'));

                return $this->render(
                    '/shared/message',
                    [
                        'title' => Yii::t('usuario', 'Password has been changed'),
                        'module' => $this->module,
                    ]
                );
            }
        }

        return $this->render('reset', ['model' => $form]);
    }
}