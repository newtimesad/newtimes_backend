<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace backend\controllers\user;

use Da\User\Event\FormEvent;
use Da\User\Event\SocialNetworkConnectEvent;
use Da\User\Event\UserEvent;
use Da\User\Factory\MailFactory;
use Da\User\Form\RegistrationForm;
use Da\User\Form\ResendForm;
use Da\User\Model\SocialNetworkAccount;
use Da\User\Model\User;
use Da\User\Query\SocialNetworkAccountQuery;
use Da\User\Query\UserQuery;
use Da\User\Service\AccountConfirmationService;
use Da\User\Service\ResendConfirmationService;
use Da\User\Service\UserConfirmationService;
use Da\User\Service\UserCreateService;
use Da\User\Service\UserRegisterService;
use Da\User\Traits\ContainerAwareTrait;
use Da\User\Traits\ModuleAwareTrait;
use Da\User\Validator\AjaxRequestModelValidator;
use Yii;
use yii\base\Module;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RegistrationController extends \Da\User\Controller\RegistrationController
{


    /**
     * {@inheritdoc}
     */
    public function actionRegister()
    {

        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }
        $this->layout = '@backend/views/layouts/blank.php';
        /** @var RegistrationForm $form */
        $form = $this->make(RegistrationForm::class);
        /** @var FormEvent $event */
        $event = $this->make(FormEvent::class, [$form]);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->trigger(FormEvent::EVENT_BEFORE_REGISTER, $event);

            /** @var User $user */

            // Create a temporay $user so we can get the attributes, then get
            // the intersection between the $form fields  and the $user fields.
            $user = $this->make(User::class, []);
            $fields = array_intersect_key($form->attributes, $user->attributes);

            // Becomes password_hash
            $fields['password'] = $form['password'];

            $user = $this->make(User::class, [], $fields);

            $user->setScenario('register');
            $mailService = MailFactory::makeWelcomeMailerService($user);

            if ($this->make(UserRegisterService::class, [$user, $mailService])->run()) {
                if ($this->module->enableEmailConfirmation) {
                    Yii::$app->session->setFlash(
                        'info',
                        Yii::t(
                            'usuario',
                            'Your account has been created and a message with further instructions has been sent to your email'
                        )
                    );
                } else {
                    Yii::$app->session->setFlash('info', Yii::t('usuario', 'Your account has been created'));
                }
                $this->trigger(FormEvent::EVENT_AFTER_REGISTER, $event);
                $role = Yii::$app->authManager->getRole('client');
                Yii::$app->authManager->assign($role, $user->id);
                return $this->redirect(['//user/login']);
            }
            Yii::$app->session->setFlash('danger', Yii::t('usuario', 'User could not be registered.'));
        }
        return $this->render('register', ['model' => $form, 'module' => $this->module]);
    }


    /**
     * {@inheritdoc}
     */
    public function actionConfirm($id, $code)
    {
        /** @var User $user */
        $user = $this->userQuery->whereId($id)->one();

        if ($user === null || $this->module->enableEmailConfirmation === false) {
            throw new NotFoundHttpException();
        }

        /** @var UserEvent $event */
        $event = $this->make(UserEvent::class, [$user]);
        $userConfirmationService = $this->make(UserConfirmationService::class, [$user]);

        $this->trigger(UserEvent::EVENT_BEFORE_CONFIRMATION, $event);

        if ($this->make(AccountConfirmationService::class, [$code, $user, $userConfirmationService])->run()) {
            Yii::$app->user->login($user, $this->module->rememberLoginLifespan);
            Yii::$app->session->setFlash('success', Yii::t('usuario', 'Thank you, registration is now complete.'));

            $this->trigger(UserEvent::EVENT_AFTER_CONFIRMATION, $event);
        } else {
            Yii::$app->session->setFlash(
                'danger',
                Yii::t('usuario', 'The confirmation link is invalid or expired. Please try requesting a new one.')
            );
        }

        return $this->redirect(['//site/index']);
    }

    /**
     * {@inheritdoc}
     */
    public function actionResend()
    {
        $this->layout = '@backend/views/layouts/blank.php';
        if ($this->module->enableEmailConfirmation === false) {
            throw new NotFoundHttpException();
        }
        /** @var ResendForm $form */
        $form = $this->make(ResendForm::class);
        $event = $this->make(FormEvent::class, [$form]);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            /** @var User $user */
            $user = $this->userQuery->whereEmail($form->email)->one();
            $success = true;
            if ($user !== null) {
                $this->trigger(FormEvent::EVENT_BEFORE_RESEND, $event);
                $mailService = MailFactory::makeConfirmationMailerService($user);
                if ($success = $this->make(ResendConfirmationService::class, [$user, $mailService])->run()) {
                    $this->trigger(FormEvent::EVENT_AFTER_RESEND, $event);
                    Yii::$app->session->setFlash(
                        'info',
                        Yii::t(
                            'usuario',
                            'A message has been sent to your email address. It contains a confirmation link that you must click to complete registration.'
                        )
                    );
                }
            }
            if ($user === null || $success === false) {
                Yii::$app->session->setFlash(
                    'danger',
                    Yii::t(
                        'usuario',
                        'We couldn\'t re-send the mail to confirm your address. Please, verify is the correct email or if it has been confirmed already.'
                    )
                );

            } else {
                Yii::$app->session->setFlash(
                    'success',
                    Yii::t('usuario', 'A new confirmation link has been sent')
                );
            }
            return $this->redirect(['//user/login']);

        }

        return $this->render(
            'resend',
            [
                'model' => $form,
            ]
        );
    }
}
