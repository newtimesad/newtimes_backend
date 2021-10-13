<?php

namespace console\controllers;

use common\models\User;

class InitController extends BaseController
{
    public function actionInitAll(){
        $this->actionInitRoles();
        $this->actionInitUsers();
//        $this->actionInitCountries();
//        $this->actionInitStates();
//        $this->actionInitCities();
    }

    public function actionInitRoles(){
        $roles = [
            'admin' => "System superadmin",
            'manager' => "System manager",
            'client' => "System client"
        ];

        $authManager = \Yii::$app->getAuthManager();

        foreach ($roles as $roleName => $roleDescription){
            $role = $authManager->getRole($roleName);
            if(empty($role)){
                $role = $authManager->createRole($roleName);
                $role->description = $roleDescription;
                $authManager->add($role);
                $this->success("Role {$roleName} has been created and added to the system");
            }else{
                $this->warning("Role {$roleName} already exists");
            }
        }
    }

    public function actionInitUsers(){
        $authManager = \Yii::$app->getAuthManager();

        $adminIds = $authManager->getUserIdsByRole('admin');
        if(empty($adminIds)){
            $user = new User([
                'username' => \Yii::$app->params['admin.username'],
                'email' => \Yii::$app->params['admin.email'],
                'password' => \Yii::$app->params['admin.password'],
                'created_at' => time(),
                'auth_key' => '',
            ]);

            $user->save(false);
            $this->success("User admin has been created");

            $adminRole = $authManager->getRole('admin');
            $authManager->assign($adminRole, $user->id);

            $this->success("Role admin has been assigned to admin user");
        }else{
            $this->warning("User admin already exists");
        }

    }

    public function actionInitCountries(){

    }

    public function actionInitStates(){}

    public function actionInitCities(){}

}
