<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AdminLtePluginAsset;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AdminLtePluginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<?php $this->beginBody() ?>

<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->

            <li class="nav-item">
                <?=
                    \yii\bootstrap4\Html::a(
                            FAS::icon(FAS::_DOOR_OPEN),
                        Url::to(['//user/security/logout']),
                        [
                                'data' => [
                                        'method' => 'post',
                                    'slide' => "true"
                                ],
                            'class' => 'nav-link',

                        ]
                    )
                ?>
            </li>
        </ul>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <div href="#" class="text-center">
            <img src="<?= Yii::getAlias("@web/images/logo.png") ?>"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle w-75" >
<!--            <span class="brand-text font-weight-light">AdminLTE 3</span>-->
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">@<?= Yii::$app->user->getIdentity()->username ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <a href="<?= \yii\helpers\Url::to(['country/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Countries

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= \yii\helpers\Url::to(['state/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                States

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= \yii\helpers\Url::to(['city/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Cities

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= \yii\helpers\Url::to(['location/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Locations

                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="<?= \yii\helpers\Url::to(['service/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Services

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= \yii\helpers\Url::to(['post-type/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Post types

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= \yii\helpers\Url::to(['speciality-category/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Speciality Categories

                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= \yii\helpers\Url::to(['business-profile/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Profiles

                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>
                                Payments

                            </p>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?= $this->title ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            'options' => ['class' => 'breadcrumb float-sm-right'],
                            'itemTemplate' => "<li class='breadcrumb-item'>{link}</li>\n",
                            'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                            'encodeLabels' => false,
                        ]) ?>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <div class="container-fluid">
                <?= $content ?>
            </div>
        </section>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
