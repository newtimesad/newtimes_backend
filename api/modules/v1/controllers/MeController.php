<?php

namespace api\modules\v1\controllers;

use api\models\user\Profile;

class MeController extends BaseActiveController
{
    public $modelClass = Profile::class;
}
