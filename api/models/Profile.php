<?php

namespace api\models;

class Profile extends \common\models\BusinessProfile
{
    public function fields()
    {
        $fields = parent::fields();
        $fields['pictures'] = 'picturesUrls';
        $fields['city'] = 'cityStr';
        $fields['email'] = 'emailStr';
        $fields['phone'] = 'phoneStr';
        $fields['available_to'] = 'formattedAvailableTo';
        $fields['aviability'] = function($model){
            return implode(' / ', $model->_availability);
        };
        return $fields;
    }


}