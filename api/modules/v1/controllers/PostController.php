<?php

namespace api\modules\v1\controllers;

use common\models\Post;

class PostController extends BaseActiveController
{
    public $modelClass = Post::class;
}
