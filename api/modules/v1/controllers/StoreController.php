<?php


namespace api\modules\v1\controllers;


use common\models\Store;
use yii\rest\ActiveController;

class StoreController extends ActiveController
{
    public $modelClass = Store::class;
}
