<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use Da\User\Model\User;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View   $this
 * @var User   $user
 * @var string $content
 */

$this->title = Yii::t('usuario', 'Update user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('usuario', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="clearfix"></div>


<div class="row">
    <div class="col-md-12">
        <div class="card bg-dark">
            <div class="card-body">
                <?= $this->render('/shared/_menu') ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-dark">
                            <div class="card-body">
                                <?= Nav::widget(
                                    [
                                        'options' => [
                                            'class' => 'bg-dark nav-pills nav-stacked',
                                        ],
                                        'items' => [
                                            [
                                                'label' => Yii::t('usuario', 'Account details'),
                                                'url' => ['/user/admin/update', 'id' => $user->id],
                                            ],
                                            [
                                                'label' => Yii::t('usuario', 'Profile details'),
                                                'url' => ['/user/admin/update-profile', 'id' => $user->id],
                                            ],
                                            [
                                                'label' => Yii::t('usuario', 'Information'),
                                                'url' => ['/user/admin/info', 'id' => $user->id],
                                            ],
                                            [
                                                'label' => Yii::t('usuario', 'Assignments'),
                                                'url' => ['/user/admin/assignments', 'id' => $user->id],
                                            ],
                                            '<hr>',
                                            [
                                                'label' => Yii::t('usuario', 'Confirm'),
                                                'url' => ['/user/admin/confirm', 'id' => $user->id],
                                                'visible' => !$user->isConfirmed,
                                                'linkOptions' => [
                                                    'class' => 'text-success',
                                                    'data-method' => 'post',
                                                    'data-confirm' => Yii::t(
                                                        'usuario',
                                                        'Are you sure you want to confirm this user?'
                                                    ),
                                                ],
                                            ],
                                            [
                                                'label' => Yii::t('usuario', 'Block'),
                                                'url' => ['/user/admin/block', 'id' => $user->id],
                                                'visible' => !$user->isBlocked,
                                                'linkOptions' => [
                                                    'class' => 'text-danger',
                                                    'data-method' => 'post',
                                                    'data-confirm' => Yii::t(
                                                        'usuario',
                                                        'Are you sure you want to block this user?'
                                                    ),
                                                ],
                                            ],
                                            [
                                                'label' => Yii::t('usuario', 'Unblock'),
                                                'url' => ['/user/admin/block', 'id' => $user->id],
                                                'visible' => $user->isBlocked,
                                                'linkOptions' => [
                                                    'class' => 'text-success',
                                                    'data-method' => 'post',
                                                    'data-confirm' => Yii::t(
                                                        'usuario',
                                                        'Are you sure you want to unblock this user?'
                                                    ),
                                                ],
                                            ],
                                            [
                                                'label' => Yii::t('usuario', 'Delete'),
                                                'url' => ['/user/admin/delete', 'id' => $user->id],
                                                'linkOptions' => [
                                                    'class' => 'text-danger',
                                                    'data-method' => 'post',
                                                    'data-confirm' => Yii::t(
                                                        'usuario',
                                                        'Are you sure you want to delete this user?'
                                                    ),
                                                ],
                                            ],
                                        ],
                                    ]
                                ) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card bg-dark">
                            <div class="card-body">
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
