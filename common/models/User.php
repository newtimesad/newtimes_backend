<?php


namespace common\models;


use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;


/**
 *
 * @property-read string $profileFullName
 */
class User extends \Da\User\Model\User
{

    public function fields()
    {
        return [
            'id',
            'username',
            'email',
        ];
    }

    public function extraFields()
    {
        return ['profile', 'roles', 'profileFullName'];
    }


    /**
     * @return string
     */
    public function getProfileFullName()
    {
        return !is_null($this->profile) ? $this->profile->name . " " . $this->profile->first_surname . " " . $this->profile->second_surname : '';
    }

    /**
     * @inheritdoc
     *
     */
    public function afterSave($insert, $changedAttributes)
    {
        ActiveRecord::afterSave($insert, $changedAttributes);
    }

}
