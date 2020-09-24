<?php

namespace api\models\user;

use Da\User\Helper\SecurityHelper;
use Da\User\Query\UserQuery;
use Da\User\Traits\ContainerAwareTrait;
use Yii;
use yii\base\InvalidParamException;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends \Da\User\Form\LoginForm
{

    public function formName()
    {
        return '';
    }
}
