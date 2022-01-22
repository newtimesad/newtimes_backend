<?php

namespace api\models;

class Profile extends \common\models\BusinessProfile
{
    public function fields()
    {
        $fields = parent::fields();
        $fields['pictures'] = 'picturesUrls';

        return $fields;
    }
}