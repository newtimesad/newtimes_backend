<?php

namespace api\models;

class Post extends \common\models\Post
{
    public function extraFields()
    {
        $extraFields = parent::extraFields();
        $extraFields['profile'] = 'businessProfile';

        return $extraFields;
    }

    public function getBusinessProfile()
    {
        return $this->hasOne(Profile::class, ['id' => 'business_profile_id']);
    }

    public function fields()
    {
        $fields = parent::fields();

        $fields['isVip'] = function($model){
            return false;
        };

        return $fields;
    }


}