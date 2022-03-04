<?php

namespace console\controllers;

use common\models\City;
use common\models\Country;
use common\models\Service;
use common\models\State;
use common\models\User;
use Symfony\Component\Yaml\Yaml;

class InitController extends BaseController
{
    public function actionInitAll()
    {
        $this->actionInitRoles();
        $this->actionInitUsers();
        $this->actionInitCountries();
        $this->actionInitServices();
    }

    public function actionInitRoles()
    {
        $roles = [
            'admin' => "System superadmin",
            'manager' => "System manager",
            'client' => "System client"
        ];

        $authManager = \Yii::$app->getAuthManager();

        foreach ($roles as $roleName => $roleDescription) {
            $role = $authManager->getRole($roleName);
            if (empty($role)) {
                $role = $authManager->createRole($roleName);
                $role->description = $roleDescription;
                $authManager->add($role);
                $this->success("Role {$roleName} has been created and added to the system");
            } else {
                $this->warning("Role {$roleName} already exists");
            }
        }
    }

    public function actionInitUsers()
    {
        $authManager = \Yii::$app->getAuthManager();

        $adminIds = $authManager->getUserIdsByRole('admin');
        if (empty($adminIds)) {
            $user = new User([
                'username' => \Yii::$app->params['admin.username'],
                'email' => \Yii::$app->params['admin.email'],
                'password' => \Yii::$app->params['admin.password'],
                'created_at' => time(),
                'confirmed_at' => time(),
                'auth_key' => '',
            ]);

            $user->save(false);
            $this->success("User admin has been created");

            $adminRole = $authManager->getRole('admin');
            $authManager->assign($adminRole, $user->id);

            $this->success("Role admin has been assigned to admin user");
        } else {
            $this->warning("User admin already exists");
        }

    }

    public function actionInitCountries()
    {
        $data = [
            [
                'name' => "United States",
                'code_2' => "US",
                'code_3' => "USA",
                'longitude' => '37.0902° N',
                'latitude' => '95.7129° W',
                'statesInfo' => [
                    [
                        'name' => 'Alabama',
                        'code_2' => 'AL',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Conneticut',
                        'code_2' => 'CT',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Ilinois',
                        'code_2' => 'IL',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Maine',
                        'code_2' => 'MA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Missouri',
                        'code_2' => 'MI',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [

                                'name' => 'Kansas City',
                                'code_2' => 'KC',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'St Lois',
                                'code_2' => 'SL',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                    ],
                    [

                        'name' => 'New Mexico',
                        'code_2' => 'NM',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Oregon',
                        'code_2' => 'OR',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Tennessee',
                        'code_2' => 'TN',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [
                                'name' => 'Menphis',
                                'code_2' => 'ME',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Nashville',
                                'code_2' => 'NA',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                    ],
                    [

                        'name' => 'Washinton DC',
                        'code_2' => 'DC',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Alaska',
                        'code_2' => 'AS',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Delaware',
                        'code_2' => 'DL',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Indiana',
                        'code_2' => 'IN',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Maryland',
                        'code_2' => 'MD',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Montana',
                        'code_2' => 'MT',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'New York',
                        'code_2' => 'NY',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [
                                'name' => 'Albany',
                                'code_2' => 'NY',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Buffalo',
                                'code_2' => 'NY',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'New York City',
                                'code_2' => 'NY',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                    ],
                    [

                        'name' => 'Pennsylvania',
                        'code_2' => 'PA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [
                                'name' => 'Hiladelphia',
                                'code_2' => 'PA',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Pittsburg',
                                'code_2' => 'PA',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                    ],
                    [

                        'name' => 'Texas',
                        'code_2' => 'TX',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [

                                'name' => 'Austin',
                                'code_2' => 'TX',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Dallas',
                                'code_2' => 'TX',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'San Antonio',
                                'code_2' => 'TX',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Houton',
                                'code_2' => 'TX',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                    ],
                    [

                        'name' => 'West Virginia',
                        'code_2' => 'VA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Arizona',
                        'code_2' => 'AZ',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Florida',
                        'code_2' => 'FL',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [
                                'name' => 'Miami',
                                'code_2' => 'FL',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [
                                'name' => 'Naples',
                                'code_2' => 'FL',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'North Florida',
                                'code_2' => 'FL',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Orlando',
                                'code_2' => 'FL',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Tampa',
                                'code_2' => 'FL',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                    ],
                    [
                        'name' => 'Conneticut',
                        'code_2' => 'CT',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Hawaii',
                        'code_2' => 'HI',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Iowa',
                        'code_2' => 'IA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Maine',
                        'code_2' => 'ME',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Minnesota',
                        'code_2' => 'MN',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Nebraska',
                        'code_2' => 'NE',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Massachusetts',
                        'code_2' => 'MA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'North Carolina',
                        'code_2' => 'NC',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Utha',
                        'code_2' => 'UT',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Wisconsin',
                        'code_2' => 'WI',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Arcansas',
                        'code_2' => 'AK',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Georgia',
                        'code_2' => 'GA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Michigan',
                        'code_2' => 'MI',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Nevada',
                        'code_2' => 'NV',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [
                                'name' => 'Las Vegas',
                                'code_2' => 'NV',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Reno & Tahoe',
                                'code_2' => 'NV',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                    ],
                    [

                        'name' => 'North Dakota',
                        'code_2' => 'ND',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Vermont',
                        'code_2' => 'VT',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Wioming',
                        'code_2' => 'WI',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'California',
                        'code_2' => 'CA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [
                                'name' => 'Los Angeles',
                                'code_2' => 'CA',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'Sacramento',
                                'code_2' => 'CA',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'San Diego',
                                'code_2' => 'CA',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'San Francisco',
                                'code_2' => 'CA',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ],
                            [

                                'name' => 'San Jose',
                                'code_2' => 'CA',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                    ],
                    [

                        'name' => 'Kentucky',
                        'code_2' => 'KY',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Ohio',
                        'code_2' => 'OH',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'South Caroline',
                        'code_2' => 'SC',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Virginia',
                        'code_2' => 'VA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Colorado',
                        'code_2' => 'CO',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Idaho',
                        'code_2' => 'ID',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Luisiana',
                        'code_2' => 'LA',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => []
                    ],
                    [

                        'name' => 'Mississippi',
                        'code_2' => 'MS',
                        'code_3' => '',
                        'longitude' => '',
                        'latitude' => '',
                        'available' => 1,
                        'citiesInfo' => [
                            [
                                'name' => 'Biloxi',
                                'code_2' => 'MS',
                                'code_3' => '',
                                'longitude' => '',
                                'latitude' => '',
                                'available' => 1,
                                'citiesInfo' => []
                            ]
                        ],
                        [

                            'name' => 'New Jersey',
                            'code_2' => 'NJ',
                            'code_3' => '',
                            'longitude' => '',
                            'latitude' => '',
                            'available' => 1,
                            'citiesInfo' => []
                        ],
                        [

                            'name' => 'Oklahoma',
                            'code_2' => 'OK',
                            'code_3' => '',
                            'longitude' => '',
                            'latitude' => '',
                            'available' => 1,
                            'citiesInfo' => []
                        ],
                        [

                            'name' => 'Washintong',
                            'code_2' => 'WA',
                            'code_3' => '',
                            'longitude' => '',
                            'latitude' => '',
                            'available' => 1,
                            'citiesInfo' => []
                        ]
                    ]
                ]
            ]
        ];
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($data as $countryInfo) {
                $country = new Country();
                if ($country->load($countryInfo, '') and $country->save()) {
                    $this->success("Country {$country->name} has been created");
                    foreach ($countryInfo['statesInfo'] as $stateInfo) {
                        $state = new State();
                        $state->country_id = $country->id;
                        if ($state->load($stateInfo, '') and $state->save()) {
                            $this->success("State {$state->name} has been created");
                            foreach ($stateInfo['citiesInfo'] as $cityInfo) {
                                $city = new City();
                                $city->state_id = $state->id;
                                if ($city->load($cityInfo, '') and $city->save()) {
                                    $this->success("City {$city->name} has been created");
                                } else {
                                    $this->error(json_encode($city->errors));
                                }
                            }
                        } else {
                            $this->error(json_encode($state->errors));
                        }
                    }
                } else {
                    $this->error(json_encode($country->errors));
                }

            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->error(Yaml::dump($e->getMessage()));
        }
    }

    public function actionInitServices()
    {
        $services = [
            [
                'name' => 'Escort',
                'price' => 30,
            ],
            [
                'name' => 'Massage',
                'price' => 25,
            ],
            [
                'name' => 'Tantra',
                'price' => 25,
            ],
            [
                'name' => 'Fantasy',
                'price' => 25,
            ],
            [
                'name' => 'Bdsm',
                'price' => 25,
            ],
            [
                'name' => 'Dancer',
                'price' => 25,
            ],
        ];

        foreach ($services as $serviceInfo) {
            $service = new Service();
            if ($service->load($serviceInfo, '') and $service->save()) {
                foreach (City::find()->all() as $city) {
                    $service->link('cities', $city);
                }
            }
        }
    }


}
