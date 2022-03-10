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
                        "name" => "Alabama",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Alabaster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Albertville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alexander City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anniston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arab",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Athens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atmore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Auburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bessemer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Birmingham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Capshaw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Center Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Childersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cullman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Daleville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Daphne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Decatur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dothan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Enterprise",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eufaula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairhope",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Payne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gadsden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grove Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Guntersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hampton Cove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanceville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hartselle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Headland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Helena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hodges",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Homewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hoover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hueytown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jacksonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jasper",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leeds",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Luverne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mobile",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montgomery",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mountain Brook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Muscle Shoals",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Notasulga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Opelika",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oxford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ozark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pelham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pell City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pennsylvania",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Phenix City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prattville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prichard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ramer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roanoke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saraland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scottsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Selma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sheffield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smiths",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sumiton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sylacauga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Talladega",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thomasville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trafford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Troy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trussville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tuscaloosa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tuskegee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vestavia Hills",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Alaska",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Anchorage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barrow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bethel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "College",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairbanks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Homer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Juneau",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kenai",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ketchikan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kodiak",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nome",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palmer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sitka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Soldotna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sterling",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Unalaska",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valdez",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wasilla",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Arizona",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Apache Junction",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Avondale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bisbee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bouse",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bullhead City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carefree",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Casa Grande",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Casas Adobes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chandler",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarkdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cottonwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Douglas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Drexel Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Mirage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Flagstaff",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Flowing Wells",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Mohave",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fortuna Foothills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fountain Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gilbert",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glendale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Globe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goodyear",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Green Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Havasu City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laveen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Litchfield Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mesa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Kingman-Butler",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nogales",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oracle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oro Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paradise Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parker",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Payson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peoria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Phoenix",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pinetop",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prescott",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prescott Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Quartzsite",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Queen Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rio Rico",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Safford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Luis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scottsdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sedona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sierra Vista",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sierra Vista Southeast",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sun City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sun City West",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Surprise",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tempe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tombstone",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tucson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winslow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yuma",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Arkansas",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Alexander",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arkadelphia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Batesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bella Vista",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Benton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bentonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berryville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blytheville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cabot",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cherry Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corning",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Dorado",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fayetteville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forrest City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Smith",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hope",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hot Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jacksonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jonesboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Little Rock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Magnolia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mountain Home",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norfork",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Little Rock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paragould",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Piggott",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pine Bluff",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pocahontas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prescott",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Quitman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rogers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Russellville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Searcy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sheridan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sherwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Siloam Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stuttgart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Texarkana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Van Buren",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ward",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Helena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Memphis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wynne",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "California",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Acton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Adelanto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Agoura Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aguanga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alameda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alamo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Albany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alhambra",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aliso Viejo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alondra Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alpine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alta Loma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Altadena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "American Canyon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anaheim",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anderson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Antelope",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Antioch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Apple Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aptos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arcadia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arcata",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arden-Arcade",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arroyo Grande",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Artesia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arvin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atascadero",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atwater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Auburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Avalon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Avenal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Avocado Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Azusa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bakersfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baldwin Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Banning",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barstow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bay Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baywood-Los Osos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bear Valley Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beaumont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bell Gardens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellflower",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ben Lomond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Benicia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berkeley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beverly Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Big Bear Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blythe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bonita",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bostonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brawley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brentwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brisbane",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Buena Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burbank",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlingame",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burnham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Byron",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Calabasas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Calexico",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "California City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camarillo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cameron Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camino",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camp Pendleton North",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camp Pendleton South",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Campbell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canoga Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canyon Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Capitola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carlsbad",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carmel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carmel Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carmichael",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carpinteria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Casa de Oro-Mount Helix",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Castaic",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Castro Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cathedral City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cayucos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ceres",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cerritos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charter Oak",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chatsworth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cherryland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chico",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chino",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chino Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chula Vista",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Citrus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Citrus Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "City of Commerce",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "City of Industry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Claremont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clearlake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clovis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coachella",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coalinga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colfax",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colusa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Commerce",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Compton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Concord",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corcoran",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corning",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coronado",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corte Madera",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Costa Mesa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cotati",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cottonwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Country Club",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Covina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crestline",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cudahy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Culver City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cupertino",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cypress",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Daly City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dana Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Danville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Davis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Del Mar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Delano",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Desert Hot Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Diamond Bar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dinuba",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dixon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Downey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Duarte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dublin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Foothills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Hemet",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East La Mirada",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Palo Alto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East San Gabriel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Cajon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Centro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Cerrito",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Granada",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Monte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Paso de Robles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Segundo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Sobrante",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elk Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Emeryville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Encinitas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Encino",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Escondido",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Etna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eureka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Exeter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fair Oaks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairfax",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fallbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ferndale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fillmore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florence-Graham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Folsom",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fontana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Foothill Farms",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Foothill Ranch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forestville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Bragg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fortuna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Foster City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fountain Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Freedom",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fremont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fresno",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fullerton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Galt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garberville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garden Acres",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garden Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gardena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Georgetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gilroy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glen Avon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glendale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glendora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goleta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gonzales",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Granada Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Terrace",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grass Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grover Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gualala",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Guerneville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hacienda Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Half Moon Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harbor City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hawaiian Gardens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hawthorne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hayward",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hemet",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hercules",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hermosa Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hesperia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillsborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hollister",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hollywood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntington Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntington Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Idyllwild",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Imperial Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Indio",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Industry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Inglewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Irvine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Irwindale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Isla Vista",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jackson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jamul",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Canada Flintridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Crescenta-Montrose",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Habra",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Jolla",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Mesa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Mirada",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Palma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Presa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Puente",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Quinta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Riviera",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Verne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ladera Ranch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lafayette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laguna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laguna Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laguna Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laguna Niguel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Elsinore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lamont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lancaster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Larkspur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "LaVerne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawndale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laytonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lemon Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lemoore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lennox",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Linda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lindsay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Live Oak",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Livermore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Livingston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lodi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Loma Linda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lomita",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lompoc",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Long Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Alamitos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Altos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Angeles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Angeles East",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Banos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Gatos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Olivos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lynwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacKinleyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madera",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Magalia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Malibu",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mammoth Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manhattan Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manteca",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marina del Rey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mariposa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marshall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Martinez",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maywood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Menlo Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Merced",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middletown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Midway City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mill Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millbrae",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milpitas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mira Loma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miranda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mission Viejo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Modesto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monclair",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monrovia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montara",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montclair",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montebello",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montecito",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monterey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monterey Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moorpark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moraga Town",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moreno Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morgan Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morro Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moss Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Shasta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mountain View",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Murrieta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "N. Hollywood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Napa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "National City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nevada City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newport Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Auburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Fair Oaks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Fork",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Highlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Hollywood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwalk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Novato",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nuevo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak View",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakhurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oceanside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oildale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ojai",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olivehurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ontario",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orangevale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orcutt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oregon House",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orinda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oroville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oxnard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pacific Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pacific Palisades",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pacifica",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pacoima",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pajaro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm Desert",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palmdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palo Alto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palos Verdes Estates",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pamona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Panorama City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paradise",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paramount",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parkway-South Sacramento",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parlier",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pasadena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Patterson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pedley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Perris",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Petaluma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pico Rivera",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Piedmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pinole",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pismo Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pittsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Placentia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Placerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Playa del Rey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasant Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasanton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plymouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Point Reyes Station",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pollock Pines",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pomona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Costa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Hueneme",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Porterville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Poway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Quartz Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ramona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rancho Cordova",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rancho Cucamonga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rancho Dominguez",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rancho Mirage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rancho Murieta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rancho Palos Verdes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rancho San Diego",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rancho Santa Margarita",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Red Bluff",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redding",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redondo Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redwood City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reedley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reseda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rialto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ridgecrest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rio del Mar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rio Linda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rio Nido",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverbank",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rocklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rohnert Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rolling Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rosamond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roseland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rosemead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rosemont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roseville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rossmoor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rowland Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rubidoux",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sacramento",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salinas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Anselmo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Bernardino",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Bruno",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Buenaventura",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Carlos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Clemente",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Diego",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Dimas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Fernando",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Francisco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Gabriel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Jacinto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Jose",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Juan Capistrano",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Leandro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Lorenzo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Luis Obispo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Marcos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Marino",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Mateo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Pablo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Pedro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Rafael",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Ramon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Ysidro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sanger",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Ana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Barbara",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Clara",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Clarita",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Cruz",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Fe Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Maria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Monica",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Paula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Rosa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Ynez",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saratoga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sausalito",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scotts Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seal Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seaside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sebastopol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Selma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shafter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sherman Oaks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sierra Madre",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Signal Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Simi Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Solana Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Soledad",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Solvang",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sonoma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sonora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Soquel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South El Monte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Gate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Lake Tahoe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Pasadena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South San Francisco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South San Jose Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Whittier",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Yuba City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spring Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "St. Helena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stanford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stanton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stevenson Ranch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stockton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Strathmore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Studio City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Suisun City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sun City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sun Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunnyvale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Susanville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sutter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sylmar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tahoe City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tamalpais-Homestead Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tarzana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tehachapi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Temecula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Temple City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thousand Oaks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tiburon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Topanga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Torrance",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trabuco Canyon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tracy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trinidad",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Truckee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tujunga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tulare",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Turlock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tustin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tustin Foothills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Twentynine Palms",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Twentynine Palms Base",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ukiah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Union City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Upland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vacaville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valencia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valinda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valle Vista",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vallejo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valley Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valley Glen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valley Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Van Nuys",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vandenberg Air Force Base",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Venice",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ventura",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Victorville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "View Park-Windsor Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vincent",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Visalia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vista",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walnut",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walnut Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walnut Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wasco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watsonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Athens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Carson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Covina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Hollywood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Puente Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Sacramento",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Whittier-Los Nietos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westlake Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westminster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whittier",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wildomar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willits",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willowbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Windsor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodland Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yorba Linda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yreka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yuba City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yucaipa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yucca Valley",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Colorado",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Air Force Academy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alamosa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Applewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arvada",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aspen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aurora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Avon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Basalt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellvue",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Black Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boulder",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brighton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Broomfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canon City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carbondale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Castle Rock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Castlewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Centennial",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cimarron Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clifton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colorado Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Commerce City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cortez",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crawford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Denver",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Durango",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edwards",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elizabeth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Englewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Estes Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evergreen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Federal Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Carson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Collins",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Morgan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fountain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Golden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Junction",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greeley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenwood Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gunbarrel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highlands Ranch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ken Caryl",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lafayette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Littleton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Longmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Louisville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Loveland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lyons",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montrose",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monument",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nederland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Niwot",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northglenn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pagosa Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parker",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Penrose",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peyton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pueblo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ridgway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rifle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rocky Ford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sanford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Security-Widefield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sherrelwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Silver Cliff",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Snowmass Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southglenn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Steamboat Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sterling",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Superior",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Telluride",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thornton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vail",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Welby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westcliffe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westminster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wheat Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodland Park",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Connecticut",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Ansonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Avon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bethel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bethlehem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Branford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bridgeport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bristol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canaan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Central Manchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cheshire",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conning Towers-Nautilus Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coscob",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cranbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cromwell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Danbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Darien",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dayville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Derby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Hartford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ellington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Enfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glastonbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greens Farms",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenwich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Groton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Guilford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haddam",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hartford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harwinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lyme",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Meriden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middletown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mystic",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Naugatuck",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Britain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Canaan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Hartford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New London",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Town",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Stonington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwalk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Old Saybrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oneco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pawcatuck",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plainville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "pomfret",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Putnam",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rocky Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rowayton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sandy Hook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seymour",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sharon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Windsor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stamford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sterling",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Storrs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stratford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Suffield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Taftville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Terryville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tolland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Torrington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trumbull",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wallingford Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Hartford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wethersfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willimantic",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Windsor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Windsor Locks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winsted",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodstock",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Delaware",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Bear",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Claymont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dover Base Housing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edgemoor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elsmere",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Georgetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middletown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pike Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seaford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smyrna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stanton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Talleyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilmington Manor",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "District of Columbia",
                        "available" => 1,
                        "citiesInfo" => []
                    ],
                    [
                        "name" => "Florida",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Alachua",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Altamonte Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Apopka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atlantic Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Auburndale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aventura",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Avon Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Azalea Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bal Harbour",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bartow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bayonet Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bayshore Gardens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellair-Meadowbrook Terrace",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belle Glade",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beverly Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomingdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boca del Mar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boca Raton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bonita Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boynton Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bradenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brandon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brent",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brooksville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brownsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Buena Ventura Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bunnell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Callaway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cape Coral",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carol City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Casselberry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Catalina Foothills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Celebration",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Century Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Citrus Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clearwater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clermont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cocoa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cocoa Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coconut Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coconut Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cooper City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coral Gables",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coral Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coral Terrace",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cortlandt Manor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Country Club",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crestview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crystal River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cutler",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cutler Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cypress Gardens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cypress Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dania",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dania Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Davie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Daytona Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "De Bary",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "De Funiak Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "De Land",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Debary",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deer Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deerfield Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Del Rio",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Delray Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deltona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Destin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Doctor Phillips",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Doral",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dundee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dunedin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edgewater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eglin Air Force Base",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Egypt Lake-Leto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elfers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Englewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ensley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eustis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairview Shores",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fern Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fernandina Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ferry Pass",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Flagler Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Floral City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florida",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florida",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florida City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florida Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Lauderdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Myers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Myers Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Pierce",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Walton Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Freeport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fruitville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ft. Lauderdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gainesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gladeview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glenvar Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Golden Gate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Golden Glades",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goldenrod",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greater Carrollwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greater Northdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Green Cove Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenacres",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gulf Gate Estates",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gulfport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haines City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hallandale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hallandale Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hammocks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamptons at Boca Raton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Havana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hialeah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hialeah Gardens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highpoint",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hobe Sound",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holiday",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holly Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hollywood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Homestead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Homosassa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Immokalee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Inverness",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Iona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ives Estates",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jacksonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jacksonville Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jasmine Estates",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jensen Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jupiter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kendale Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kendall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kendall West",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Key Biscayne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Key Largo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Key West",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kings Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kissimmee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lady Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Alfred",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Lucerne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Magdalene",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Mary",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Placid",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Wales",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Worth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeland Highlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Land O'Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Largo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lauderdale Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lauderhill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laurel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lecanto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leesburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lehigh Acres",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leisure City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lighthouse Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lockhart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Longwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Loxahatchee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lutz",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lynn Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maitland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mango",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marathon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Margate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Melbourne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Merritt Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miami",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miami Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miami Gardens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miami Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miami Shores",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miami Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Micco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mims",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miramar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mulberry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Myrtle Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Naples",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Naples Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Naranja",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Port Richey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Port Richey East",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Smyrna Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Niceville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nokomis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Andrews Gardens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Fort Myers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Lauderdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Miami",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Miami Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Naples",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Palm Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Port",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakland Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ocala",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ocoee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ojus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Okeechobee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oldsmar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olympia Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Opa-locka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orange City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orange Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orlando",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ormond Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ormond-by-the-Sea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Osprey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oviedo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palatka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm Beach Gardens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm Coast",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm River-Clair Mel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palm Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palmetto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palmetto Estates",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Panama City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parkland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pembroke Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pembroke Pines",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pensacola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Perrine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pine Castle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pine Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pinellas Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pinewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plant City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plantation",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pompano Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pompano Beach Highlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ponte Vedra",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Charlotte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Orange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Saint John",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Saint Lucie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Punta Gorda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Quincy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redington Shores",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond West",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riviera Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockledge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Royal Palm Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Safety Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Augustine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Cloud",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Petersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Petersburg Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Carlos Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sandalfoot Cove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sanford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sanibel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sarasota",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sarasota Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Satellite Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scott Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sebastian",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seminole",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shalimar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Bradenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Daytona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Miami",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Miami Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Patrick Shores",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Venice",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spring Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stuart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sun City Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunny Isles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunrise",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunset",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sweetwater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tallahassee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tamarac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tamiami",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tampa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tarpon Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Temple Terrace",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "The Crossings",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "The Hammocks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Titusville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Town'n'Country",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "University",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "University Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valrico",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Venice",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vero Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vero Beach South",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Villas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warrington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wekiva Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wellington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wesley Chapel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West and East Lealman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Little River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Palm Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Pensacola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westwood Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilton Manors",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Windermere",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winter Garden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winter Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winter Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winter Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wright",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yeehaw Junction",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Georgia",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Acworth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Adel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Albany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alpharetta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Americus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Athens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Athens-Clarke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atlanta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Auburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Augusta-Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Austell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bainbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barnesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belvedere Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bogart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bowdon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Braselton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brunswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Buford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Byron",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cairo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Calhoun",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Candler-MacAfee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carrollton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cartersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chamblee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarkston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cochran",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "College Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Comer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conyers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cordele",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Covington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Culloden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cumming",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dacula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dahlonega",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dallas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dalton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Decatur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dewy Rose",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Doraville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Douglas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Douglasville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Druid Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dublin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Duluth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dunwoody",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elberton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ellenwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ellijay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evans",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairmount",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fayetteville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Flowery Branch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Folkston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Benning South",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Gordon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Stewart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Foxborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gaines School",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gainesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glennville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gresham Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Griffin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grovetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hartwell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hinesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jackson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jonesboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kennesaw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingsland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "LaGrange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawrenceville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lilburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lithia Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lithonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Locust Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Loganville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Louisville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mableton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Macon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marietta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Martinez",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "McDonough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milledgeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morrow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moultrie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mountain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mountain Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newnan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norcross",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Atlanta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Decatur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Druid Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Panthersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peachtree City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Powder Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rex",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rome",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rossville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roswell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Marys",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Simons",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sandy Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Savannah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scottdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sharpsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smyrna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Snellville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sparks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Statesboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stockbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stone Mountain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Suwanee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thomasville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tifton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tucker",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tybee Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Union City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valdosta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vidalia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Villa Rica",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warner Robins",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waycross",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilmington Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winder",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodbine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodstock",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Hawaii",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Ahuimanu",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aiea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aliamanu",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ewa Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haiku",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Halawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanalei",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hilo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holualoa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Honolulu",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kahului",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kailua",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kalaheo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kamuela",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kaneohe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kaneohe Station",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kapaa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kapolei",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kihei",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lahaina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lanai City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lihue",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Makaha",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Makakilo City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Makawao",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mi-Wuk Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mililani Town",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Naalehu",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nanakuli",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pahoa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pearl City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schofield Barracks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wahiawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waialua",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waianae",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wailuku",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waimalu",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waipahu",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waipio",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Idaho",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Blackfoot",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boise",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boise City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boulder Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Caldwell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coeur d'Alene",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eagle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garden City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Idaho Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewiston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Meridian",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moscow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mountain Home",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nampa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Payette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pocatello",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Post Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Preston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rexburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rigby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sandpoint",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Troy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Twin Falls",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Illinois",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Addison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Algonquin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alsip",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arlington Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aurora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bannockburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barrington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bartlett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Batavia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beach Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beardstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bedford Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belleville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belvidere",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bensenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berwyn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomingdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blue Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boling Brook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bolingbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bourbonnais",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bradley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Breese",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bridgeview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brimfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Broadview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Buffalo Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burbank",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burr Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cahokia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Calumet City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carbondale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carlinville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carol Stream",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carpentersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carthage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cary",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Centralia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Champaign",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Channahon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charleston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chicago",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chicago Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chicago Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cicero",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coal City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Collinsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Congerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Country Club Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crest Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crestwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crystal Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Danville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Darien",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Decatur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deerfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "DeKalb",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Des Plaines",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dixon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dolton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Downers Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Earlville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Dundee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Moline",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Peoria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Saint Louis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edwardsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Effingham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elgin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elk Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elk Grove Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elmhurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elmwood Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evanston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evergreen Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairview Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Flossmoor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frankfort",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Freeport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Galena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Galesburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Geneva",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Genoa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glen Carbon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glen Ellyn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glencoe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glendale Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glenview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Godfrey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goodings Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Granite City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grayslake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gurnee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamilton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hampshire",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanover Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harvard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harvey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hawthorn Woods",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hazel Crest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Herrin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hickory Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highland Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hinsdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hoffman Estates",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Homewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Illinois City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ingleside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Itasca",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jacksonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Johnston City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Joliet",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Justice",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kankakee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kenilworth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kewanee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Grange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Grange Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Salle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Bluff",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake in the Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Zurich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lansing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lemont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Libertyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincoln",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincolnwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lindenhurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lindenwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lisle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lockport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lombard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Long Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Loves Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lyons",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacHenry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Machesney Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Macomb",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Markham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marshall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Martinsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maryville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Matteson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mattoon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maywood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "McHenry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Melrose Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Midlothian",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Minooka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mokena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moline",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Momence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montgomery",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monticello",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morris",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morton Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mossville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Prospect",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Zion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mundelein",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Naperville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Lenox",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Niles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Normal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Aurora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Chicago",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northlake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "O'Fallon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Lawn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orland Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Osco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ottawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palatine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palos Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palos Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Park Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Park Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pekin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peoria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peru",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plainfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pontiac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Princeton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prospect Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Quincy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ramsey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rantoul",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richton Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "River Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rochelle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rock Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rolling Meadows",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Romeoville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roscoe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roselle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Round Lake Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Charles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sauget",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sauk Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schaumburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schiller Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shumway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Skokie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Elgin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Holland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spring Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sterling",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Streamwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Streator",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Swansea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sycamore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Taylorville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tinley Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Urbana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ursa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vernon Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Villa Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walnut",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warrenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waukegan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Chicago",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Dundee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Western Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wheaton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wheeling",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willowbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilmette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winnebago",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winnetka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wood Dale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wood River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodstock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Worth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Zion",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Indiana",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Albion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anderson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Angola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Auburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bedford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beech Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brownsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carmel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedar Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chesterton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarksville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Connersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crawfordsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crown Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dyer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Chicago",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elkhart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evansville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fishers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Wayne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frankfort",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gary",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goshen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gosport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Granger",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greensburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Griffith",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hammond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Helmsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hobart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Indianapolis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jasper",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jeffersonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Knightstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kokomo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Porte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lafayette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Station",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawrence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lebanon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Liberty",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Logansport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Martinsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Merrillville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Michigan City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mishawaka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Muncie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Munster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "N. Albany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nashville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Albany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Castle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Trenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Noblesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Osceola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peru",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plainfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plymouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Poland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rising Sun",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roanoke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schererville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scottsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seymour",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelbyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Bend",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Speedway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "St. John",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Terre Haute",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thorntown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tippecanoe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Troy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valparaiso",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vermont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vincennes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wabash",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warsaw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Lafayette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Williams",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Iowa",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Altoona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ames",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ankeny",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bettendorf",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boone",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carroll",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedar Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedar Rapids",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarinda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clive",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coralville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Council Bluffs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Davenport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Des Moines",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dubuque",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eldridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elkader",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Essex",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fayette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Dodge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harlan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Indianola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Iowa City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kalona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Keokuk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marshalltown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mason City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Muscatine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orange City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oskaloosa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ottumwa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pella",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sioux City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spencer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Storm Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Urbandale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterloo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Des Moines",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Kansas",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Arkansas City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atchison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coffeyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Derby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dodge City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Dorado",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elk City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Emporia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Riley North",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garden City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Great Bend",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hays",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hutchinson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Independence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Junction City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kansas City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawrence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leavenworth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leawood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lenexa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Liberal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacPherson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manhattan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Merriam",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Minneapolis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moscow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moundridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nashville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olathe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ottawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Overland Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parsons",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pittsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prairie Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rose Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shawnee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "tecumseh",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Topeka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wichita",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winfield",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Kentucky",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Albany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bardstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bowling Green",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Campbellsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Catlettsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Covington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crescent Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Danville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dawson Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eastview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eddyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elizabethtown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Erlanger",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evarts",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fern Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Campbell North",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Knox",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Mitchell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Thomas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frankfort",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Georgetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glasgow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grays Knob",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Henderson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hopkinsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Independence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jeffersontown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawrenceburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lebanon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lexington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lexington-Fayette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Louisville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madisonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mayfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middlesborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Murray",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nebo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nicholasville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Okolona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olive Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Owensboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paducah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paris",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pikeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasure Ridge Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Queens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Radcliff",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Dennis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Matthews",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scottsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shively",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Somerset",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Shore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tollesboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valley Station",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wallins Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winchester",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Louisiana",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Abbeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alexandria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amite",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baker",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bastrop",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baton Rouge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bayou Cane",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bogalusa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bossier City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Broussard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Calhoun",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chalmette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Covington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crowley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "De Ridder",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Delcambre",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Denham Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Estelle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eunice",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Polk South",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "French Settlement",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Geismar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gretna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hammond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harahan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harvey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Houma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Independence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jefferson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jennings",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kenner",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lafayette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Charles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laplace",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mandeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marrero",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Merrydale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Metairie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Minden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morgan City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Natchitoches",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Iberia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Orleans",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Opelousas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pineville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pioneer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prairieville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "River Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ruston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Amant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Martinville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shenandoah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shreveport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Slidell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sulphur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Terrytown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thibodaux",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Timberlane",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waggaman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westwego",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Zachary",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Maine",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Auburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Augusta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bangor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bath",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Biddeford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brunswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cornish",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dover-Foxcroft",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ellsworth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Etna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Freeport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gorham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greene",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harmony",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewiston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Liberty",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Limerick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lyman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Gloucester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norridgewock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Yarmouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Old Town",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orono",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Presque Isle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sanford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scarborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Portland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spruce Head",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "stockton springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thomaston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waldoboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Buxton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitefield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Windham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yarmouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "York Harbor",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Maryland",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Aberdeen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Accokeek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Adelphi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Andrews Air Force Base",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Annapolis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arbutus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arnold",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aspen Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baltimore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bel Air North",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bel Air South",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beltsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berlin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bethesda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bladensburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boonsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bowie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brooklandville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brooklyn Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burtonsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Calverton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cambridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camp Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Capitol Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Catonsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chestertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chillum",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarksburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarksville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cockeysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "College Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cooksville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coral Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crofton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cumberland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Damascus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Darlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "District Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dundalk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Riverdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Easton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edgemere",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edgewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eldersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elkridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elkton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ellicott City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Essex",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ferndale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forestville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Meade",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Washington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frederick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fredrick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Friendly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gaithersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Germantown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glen Burnie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glenn Dale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greater Landover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greater Upper Marlboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Green Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Green Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenbelt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hagerstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harmans",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Havre de Grace",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillandale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillcrest Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hunt Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hurlock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hyattsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ijamsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jefferson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jessup",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Joppatowne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kettering",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Shore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Langley Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lanham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lanham-Seabrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lansdowne-Baltimore Highlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Largo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laurel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lexington Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lochearn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lutherville-Timonium",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marriottsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maryland City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mays Chapel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middle River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milford Mill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mitchellville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montgomery Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "National Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Carrollton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Bethesda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Laurel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Potomac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Odenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Overlea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Owings Mills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oxon Hill-Glassmanor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parkville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parole",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pasadena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Perry Hall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pikesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Poolesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Potomac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Randallstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reisterstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riviera Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rosaryville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rosedale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rossville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Charles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salisbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sandy Spring",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Savage Guilford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Severn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Severna Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Silver Spring",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Snow Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Gate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Laurel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Suitland-Silver Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Takoma Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Temple Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thurmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Timonium",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Towson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Upper Marlboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waldorf",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walker Mill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westminster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wheaton-Glenmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Oak",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Windsor Mill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodlawn",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Massachusetts",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Abington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Acton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Agawam",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amesbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amherst Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Athol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Attleboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barnstable Town",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baxboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Becket",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bedford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beverly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Billerica",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boylston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Braintree",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brockton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookline",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cambridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charlestown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chelmsford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chelsea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chicopee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Concord",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Danvers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dedham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Devens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Devenscrest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Duxbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Easthampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Everett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairhaven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fall River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fitchburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Framingham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gardner",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gloucester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Great Barrington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Groton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hadley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harvard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haverhill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hingham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holliston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holyoke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hopedale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Housatonic",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hubbardston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hull",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hyannis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ipswich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jamaica Plain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawrence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lenox",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leominster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lexington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Longmeadow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lowell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lynn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lynnfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Malden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marblehead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marlborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marshfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Massachusetts",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maynard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Melrose",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Methuen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middleboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montague",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nantucket",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Natick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Needham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Bedford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newburyport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Adams",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Andover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Attleborough Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Easton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orleans",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peabody",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pepperell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pittsfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plainfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plymouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Provincetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Quincy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Randolph",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reading",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rehoboth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Revere",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roslindale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saugus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scituate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seekonk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelburne Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sherborn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shrewsbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Somerset",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Somerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Boston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Deerfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Hadley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Lee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Yarmouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southwick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stoneham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sturbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Swampscott",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Swansea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Taunton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tewksbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Three Rivers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Truro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Upton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vineyard Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wakefield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waltham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ware",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wareham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wayland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Webster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wellesley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wellesley Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Concord",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Roxbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Yarmouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weymouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilbraham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winthrop",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Worcester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yarmouthport",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Michigan",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Adrian",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Albion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Allegan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Allen Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alpena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ann Arbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Attica",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Auburn Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Battle Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bay City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beecher",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belleville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Benton Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berkley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beverly Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Big Rapids",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Birmingham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomfield Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomfield Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boyne City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brighton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cadillac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charlotte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chesterfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarkston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clawson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Commerce",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Comstock Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coopersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cornell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cutlerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Davisburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dearborn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dearborn Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Delton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Detroit",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dexter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dowagiac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Grand Rapids",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Lansing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eastpointe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ecorse",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Escanaba",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fair Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairgrove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmington Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ferndale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Flint",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fowlerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frankenmuth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fraser",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fremont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fruitport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garden City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goodrich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Blanc",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Haven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Rapids",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grandville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grosse Ile",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grosse Pointe Farms",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grosse Pointe Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grosse Pointe Woods",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gwinn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamtramck",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hancock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harper Woods",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haslett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hazel Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highland Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Houghton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hudsonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntington Woods",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Imlay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Inkster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jackon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jackson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jenison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kalamazoo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kalkaska",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kentwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingsford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lansing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lapeer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincoln Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Litchfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Livonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ludington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Macomb",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manistee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marquette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Melvindale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Midland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Clemens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Morris",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Pleasant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mt. Pleasant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Muskegon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Muskegon Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newaygo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Niles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norton Shores",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Novi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Okemos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oscoda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Owosso",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oxford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Petoskey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pinckney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plymouth Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pontiac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Huron",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reese",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "River Rouge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rochester Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Romeo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Romulus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roseville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Royal Oak",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saginaw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saginaw Township North",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saginaw Township South",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Clair Shores",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Louis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saline",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saugatuck",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sault Sainte Marie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schoolcraft",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southgate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sterling Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sturgis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Taylor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Traverse City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Troy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walker",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walled Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warren",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waverly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wayne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Bloomfield Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitmore Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Williamston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wixom",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodhaven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wyandotte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wyoming",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ypsilanti",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Minnesota",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Albert Lea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alger",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Andover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Annandale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anoka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Apple Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Austin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baxter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bemidji",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blaine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blomkest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blue Earth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brainerd",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brooklyn Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brooklyn Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burnsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Champlin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chanhassen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chaska",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chatfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Circle Pines",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cloquet",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cokato",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbia Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coon Rapids",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cottage Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crystal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Duluth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eagan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Bethel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eden Prairie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elk River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ely",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Faribault",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fergus Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frazee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fridley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Golden Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Rapids",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ham Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hastings",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hibbing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hopkins",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Houston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hutchinson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Inver Grove Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Isanti",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "LaCrescent",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Le Sueur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lino Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Litchfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mankato",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maple Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maplewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marshall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mendota Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Minneapolis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Minnetonka",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moorhead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mounds View",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nelson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Brighton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Hope",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Ulm",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Mankato",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Saint Paul",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Onamia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Owatonna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pequot Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plymouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prior Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ramsey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Red Wing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Renville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Robbinsdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rochester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rosemount",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roseville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Royalton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Cloud",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Louis Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Michael",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Paul",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Peter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sauk Rapids",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Savage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shakopee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shoreview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Saint Paul",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "St. Paul",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stewartville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stillwater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vadnais Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waconia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wadena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Saint Paul",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Bear Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willmar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Worthington",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Mississippi",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Bay Saint Louis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Biloxi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brandon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookhaven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Byhalia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Byram",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarksdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cleveland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corinth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Diamondhead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gautier",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grenada",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gulfport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hattiesburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hernando",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Horn Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Indianola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jackson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laurel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Long Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lucedale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacComb",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Magnolia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Meridian",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Michigan City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moselle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moss Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Natchez",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ocean Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olive Branch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orange Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oxford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pascagoula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pearl",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pelahatchie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Picayune",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Quitman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ridgeland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Senatobia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southaven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southhaven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Starkville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tupelo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Utica",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vicksburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yazoo City",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Missouri",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Affton",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Annapolis",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Arnold",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Ballwin",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Belgique",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Bellefontaine Neighbors",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Belton",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Berkeley",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Blue Springs",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Branson",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Bridgeton",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Brighton",
                                "locationsName" => []
                            ],
                            [
                                "name" => "California",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Camdenton",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Cape Girardeau",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Carthage",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Chaffee",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Chesterfield",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Chillicothe",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Clayton",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Clever",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Columbia",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Concord",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Crestwood",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Creve Coeur",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Desloge",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Dora",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Earth City",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Excelsior Springs",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Farmington",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Fenton",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Ferguson",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Florissant",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Forsyth",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Fort Leonard Wood",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Fulton",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Gladstone",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Grain Valley",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Grandview",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Gravois Mills",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Hannibal",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Harrisonville",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Hazelwood",
                                "locationsName" => []
                            ],
                            [
                                "name" => "High Ridge",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Independence",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Jackson",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Jefferson City",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Jennings",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Joplin",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Kansas City",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Kennett",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Kirksville",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Kirkwood",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Kissee Mills",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Lamar",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Lebanon",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Lees Summit",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Lemay",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Liberty",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Lone Jack",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Marshall",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Maryland Heights",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Maryville",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Mehlville",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Mexico",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Moberly",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Murphy",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Nixa",
                                "locationsName" => []
                            ],
                            [
                                "name" => "O'Fallon",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Oakville",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Overland",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Pacific",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Park Hills",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Parkville",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Peculiar",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Poplar Bluff",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Raytown",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Richmond Heights",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Rolla",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Saint Ann",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Saint Charles",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Saint Clair",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Saint Joseph",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Saint Louis",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Saint Peters",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Sappington",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Sedalia",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Sikeston",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Spanish Lake",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsName" => []
                            ],
                            [
                                "name" => "St. Louis",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Steelville",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Sunrise Beach",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Town and Country",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Trimble",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Troy",
                                "locationsName" => []
                            ],
                            [
                                "name" => "University City",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Warrensburg",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Washington",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Webb City",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Webster Groves",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Wentzville",
                                "locationsName" => []
                            ],
                            [
                                "name" => "West Plains",
                                "locationsName" => []
                            ],
                            [
                                "name" => "Wildwood",
                                "locationsName" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Montana",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Anaconda-Deer Lodge County",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arlee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belgrade",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berkovica",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Billings",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bojchinovci",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bozeman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brusarci",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Butte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Butte-Silver Bow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chiprovci",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Great Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamilton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Havre",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Helena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Helena Valley Southeast",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Helena Valley West Central",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kalispell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lame Deer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laurel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewistown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Livingston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lom",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Malmstrom Air Force Base",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manhattan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miles City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Missoula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orchard Homes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pablo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Polson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roberts",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ryegate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sidney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stevensville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valchedram",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Varshec",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitefish",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Nebraska",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Beatrice",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellevue",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Central City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cozad",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Creighton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fremont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gering",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hastings",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Homer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Keamey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kearney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Vista",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lexington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincoln",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "McCook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norfolk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Platte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Offutt Air Force Base West",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ogallala",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Omaha",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Papillion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scottsbluff",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Sioux City",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Nevada",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Boulder City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carson City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elko",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goldfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Henderson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Las Vegas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laughlin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lovelock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mesquite",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nellis Air Force Base",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Las Vegas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pahrump",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paradise",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reno",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sparks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spring Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sun Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunrise Manor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winnemucca",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "New Hampshire",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Amherst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atkinson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barrington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bedford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berlin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Claremont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Concord",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Derry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Durham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Epping",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Exeter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gilford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goffstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hampstead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillsborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hollis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hooksett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Keene",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laconia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lebanon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Litchfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Londonderry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Meredith",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Merrimack",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nashua",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newmarket",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pelham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pembroke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peterborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plaistow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plymouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portsmouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Raymond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rindge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rochester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seabrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Somersworth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stratham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Swanzey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weare",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Windham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wolfeboro",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "New Jersey",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Aberdeen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Asbury Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atlantic City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barnegat",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bayonne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belleville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bergenfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berkeley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bernards Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Branchburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bridgeton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bridgewater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlington Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carteret",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cherry Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cinnaminson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "City of Orange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cliffside Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clifton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clinton Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Collingswood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cranford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Delran",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Denville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deptford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dumont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Brunswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Orange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Windsor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Egg Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elizabeth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elmwood Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Englewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evesham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ewing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fair Lawn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Lee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Freehold Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Galloway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glassboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gloucester Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hackensack",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haddon Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamilton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamilton Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hammonton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hawthorne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hazlet",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highland Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillsborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hoboken",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holmdel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hopatcong",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hopewell Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Howell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Irvington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jackson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jefferson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jersey City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kearny",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lacey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawrence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Linden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lindenwold",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Little Egg Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Little Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Livingston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lodi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Long Branch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lower Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lyndhurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mahwah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manalapan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mantua",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maple Shade",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maplewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marlboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Metuchen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middle Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middlesex",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middletown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montclair",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montgomery",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moorestown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morris Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morristown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Laurel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Olive",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Neptune",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Brunswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Arlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Bergen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Brunswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Plainfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nutley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ocean Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Old Bridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palisades Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paramus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parsippany-Troy Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Passaic",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paterson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pemberton Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pennsauken",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pennsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pequannock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Perth Amboy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Phillipsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Piscataway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plainfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plainsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasantville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Point Pleasant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Princeton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rahway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ramsey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Randolph",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Raritan Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Readington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ridgewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Robbinsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockaway Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roselle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roxbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rutherford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saddle Brook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sayreville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scotch Plains",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Secaucus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Brunswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Orange Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Plainfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sparta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stafford Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Summit",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Teaneck",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tenafly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tinton Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Toms River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Union",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Union City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Verona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vineland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Voorhees",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warren",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wayne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Deptford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West New York",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Orange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Windsor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willingboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winslow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wyckoff",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "New Mexico",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Alamogordo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Albuquerque",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anthony",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Artesia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bernalillo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carlsbad",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chaparral",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clovis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corrales",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deming",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Espanola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gallup",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grants",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hobbs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kirtland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Las Cruces",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Las Vegas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Alamos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Los Lunas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lovington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portales",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rio Rancho",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roswell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ruidoso",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Fe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shiprock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Silver City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Socorro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunland Park",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "New York",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Airmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Albany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amherst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amityville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amsterdam",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arcadia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Auburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aurora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Babylon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baldwinsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ballston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Batavia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bath",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beacon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bedford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beekman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bethlehem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Binghamton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blooming Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Briarcliff Manor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brighton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brockport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookhaven",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brunswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Buffalo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camillus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canandaigua",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carmel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Catskill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cheektowaga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chenango",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chestnut Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chili",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cicero",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarkstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clifton Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cohoes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colonie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corning",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cornwall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cortland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cortlandt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crawford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Croton-on-Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Depew",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "DeWitt (De Witt)",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dobbs Ferry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dryden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dunkirk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Fishkill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Greenbush",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Hampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Rockaway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eastchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elmira",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Endicott",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Esopus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evans",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fallsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmingdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fishkill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Floral Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fredonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Freeport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fulton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garden City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gates",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Geddes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Geneseo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Geneva",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "German Flatts",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glen Cove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glens Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gloversville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goshen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Great Neck",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greece",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenburgh",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Guilderland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Halfmoon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamlin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hastings",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hastings-on-Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haverstraw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hempstead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Henrietta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Herkimer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hornell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Horseheads",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hudson Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hyde Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ilion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Irondequoit",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Islip",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ithaca",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jamestown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Johnson City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Johnstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kenmore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kent",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingsbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kirkland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kiryas Joel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lackawanna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "LaGrange (La Grange)",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lancaster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lansing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Le Ray",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lenox",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewisboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewiston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Liberty",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lindenhurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Little Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lloyd",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lockport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Long Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lynbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lysander",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Macedon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Malone",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Malta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Malverne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mamakating",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mamaroneck",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manlius",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Massapequa Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Massena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mastic Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mechanicville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mendon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middletown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mineola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montgomery",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moreau",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Kisco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Pleasant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Castle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Hartford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Hyde Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Paltz",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Rochelle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Square",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Windsor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New York",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newburgh",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newfane",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Niagara Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Niskayuna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Castle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Greenbush",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Hempstead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Syracuse",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Tonawanda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nyack",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ogden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ogdensburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olean",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oneida",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oneonta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Onondaga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ontario",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orangetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orchard Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ossining",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oswego",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Owego",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oyster Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Patchogue",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Patterson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peekskill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pelham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Penfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Perinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Philipstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pittsford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plattekill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plattsburgh",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasant Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasantville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pomfret",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Chester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Jefferson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Jervis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Potsdam",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Poughkeepsie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Putnam Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Queensbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ramapo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Red Hook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rensselaer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverhead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rochester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockville Centre",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rome",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rotterdam",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rye",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rye Brook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salamanca",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saratoga Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saugerties",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scarsdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schenectady",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schodack",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scotia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seneca Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shawangunk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sherrill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sleepy Hollow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smithtown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Somers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southeast",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southold",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spring Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stony Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Suffern",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sullivan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sweden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Syracuse",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tarrytown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thompson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tonawanda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Troy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ulster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Union",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Utica",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valley Stream",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Van Buren",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vestal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Victor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wallkill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walworth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wappinger",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warwick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watervliet",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wawarsing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Webster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Haverstraw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Seneca",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wheatfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Plains",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitestown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Williston Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yonkers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yorktown",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "North Carolina",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Apex",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Asheboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Asheville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boone",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carrboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cary",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chapel Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charlotte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clayton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clemmons",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Concord",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cornelius",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Durham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fayetteville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fuquay-Varina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garner",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gastonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goldsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greensboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Havelock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hickory",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "High Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holly Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Indian Trail",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jacksonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kannapolis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kernersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kinston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lexington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lumberton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Matthews",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mint Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mooresville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morrisville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Bern",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Raleigh",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rocky Mount",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salisbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sanford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Statesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thomasville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wake Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winston-Salem",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "North Dakota",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Bismarck",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Devils Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dickinson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fargo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Forks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jamestown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mandan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Minot",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valley City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wahpeton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Fargo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Williston",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Ohio",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Akron",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alledonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alliance",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amherst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Apple Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Archbold",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashtabula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Athens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atwater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aurora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Austintown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Avon Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barberton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Batavia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bay Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beachwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beavercreek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bedford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bedford Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellaire",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellefontaine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellevue",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berea",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bexley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blacklick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blacklick Estates",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blanchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blue Ash",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boardman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bowling Green",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brecksville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bridgetown North",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bristolville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Broadview Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brook Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brooklyn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brunswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bryan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bucyrus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cambridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Campbell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canal Winchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carlisle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Celina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Centerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chagrin Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chardon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cheshire",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chillicothe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chippewa Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cincinnati",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Circleville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cleveland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cleveland Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conneaut",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coshocton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cuyahoga Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dayton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Defiance",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Delaware",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dublin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Cleveland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Liverpool",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eastlake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elyria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Englewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Euclid",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairborn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairview Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Findlay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Finneytown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort MacKinley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fostoria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fremont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gahanna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Galion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garfield Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Girard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glenwillow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Green",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grove City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamilton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hilliard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hiram",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huber Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ironton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kent",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kettering",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kidron",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lancaster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lebanon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewis Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lima",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincoln Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lorain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Loveland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lyndhurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Macedonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maineville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mansfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maple Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marietta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mason",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Massillon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maumee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mayfield Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mentor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miamisburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middleburg Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middletown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mineral City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Minster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Gilead",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nelsonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Albany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Philadelphia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Niles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Canton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North College Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Lewisburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Olmsted",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Ridgeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Royalton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Northview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwalk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oberlin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ohio",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oregon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Overlook-Page Manor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oxford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Painesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parma Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peninsula",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Perrysburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pickerington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Piqua",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portage Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portsmouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Powell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ravenna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reading",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reynoldsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rittman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rocky River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rossford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sandusky",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seven Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shaker Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sharonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sheffield Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sidney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Solon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Euclid",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Steubenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Streetsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Strongsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Struthers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sylvania",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tallmadge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tiffin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Toledo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trotwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Troy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Twinsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "University Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Upper Arlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Urbana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valley Glen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Van Wert",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vandalia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vermilion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wadsworth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warren",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warrensville Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waverly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Carrollton City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Chester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westlake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Oak",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitehall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wickliffe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willoughby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willowick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winesburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wooster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Worthington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Xenia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yellow Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Youngstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Zanesville",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Oklahoma",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Ada",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Altus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ardmore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bartlesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bethany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bixby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Broken Arrow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Catoosa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chickasha",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Choctaw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Claremore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Del City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Duncan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Durant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Reno",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elk City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Enid",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Sill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Guthrie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Heavener",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hugo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lindsay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacAlester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Miami",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Midwest City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morrison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Muskogee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mustang",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oklahoma City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Okmulgee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Owasso",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pawnee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ponca City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rattan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sand Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sapulpa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shawnee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stillwater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sulphur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tahlequah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "The Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tulsa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weatherford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Welch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodward",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yukon",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Ontario",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Acton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ajax",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alexandria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alfred",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alliston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Almonte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amherstburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amigo Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Angus-Borden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arnprior",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arthur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Athens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atikokan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Attawapiskat",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aurora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aylmer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ayr",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barrie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barry's Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beamsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beaverton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beeton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belleville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blenheim",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blind River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bobcaygeon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bolton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bourget",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bowmanville-Newcastle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bracebridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bradford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brantford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bridgenorth-Chemong Park Area",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brighton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brockville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brooklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brussels",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Caledon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Caledon East",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Caledonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cambridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Campbellford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Campbellville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cannington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Capreol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cardinal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carleton Place",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carlisle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Casselman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cayuga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chalk River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chapleau",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chatham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chesley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chesterville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cobourg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cochrane",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colborne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Collingwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Concord",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Constance Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cookstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cornwall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Creemore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crystal Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deep River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Delhi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deseronto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Downsview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Drayton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dresden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dryden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dundalk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dunnville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Durham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dutton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eganville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elliot Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elmira",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elmvale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Embrun",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Englehart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Erin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Espanola",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Essex",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Etobicoke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Everett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Exeter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fenelon Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fergus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Erie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Frances",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frankford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gananoque",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Georgetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Georgina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Geraldton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glencoe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goderich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Golden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gormley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Bend",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gravenhurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Guelph",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gullegem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hagersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haileybury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hamilton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harriston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hastings",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Havelock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hawkesbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hearst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hensall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillsburgh",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hornepayne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ingersoll",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Innisfil",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Iroquois",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Iroquois Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jarvis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kanata",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kapuskasing",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kars",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kemptville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kenora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kincardine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kirkland Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kitchener",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "L'Original",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakefield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lanark",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Langdorp",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leamington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lindsay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Listowel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Little Current",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lively",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "London",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Longlac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lucan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lucknow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madoc",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manitouwadge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maple",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marathon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Markdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Markham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marmora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mattawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Meaford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Metcalfe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Midland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mildmay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milverton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mississauga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mississauga Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mitchell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moose Factory",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morrisburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Albert",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Brydges",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Forest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Munster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nanticoke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Napanee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nepean",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Hamburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newmarket",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newtonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nobleton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Gower",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North York",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Omemee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Onaping-Levack",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ontario",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orangeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orillia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orono",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Osgoode",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oshawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ottawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Owen Sound",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paisley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palmerston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paris",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parkhill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parry Sound",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pembroke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Perth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Petawawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Peterborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Petrolia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pickering",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Picton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Point Edward",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Porcupine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Credit",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Dover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Elgin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Hope",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Perry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Stanley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Powassan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prescott",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Queensville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Renfrew",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ridgetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rodney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Catharines",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Catharines-Niagara",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint George",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Jacobs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Marys",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Thomas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sarnia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sault Sainte Marie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scarborough",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schomberg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seaforth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelburne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Simcoe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sioux Lookout",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smiths Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smithville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stayner",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stirling",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stoney Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stoney Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stouffville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stratford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Strathroy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sturgeon Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sudbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sutton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tavistock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Teeswater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Terrace Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thamesford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thessalon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thornbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thornhill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Thunder Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tilbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tilsonburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Timmins",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Toronto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tory Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tottenham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tweed",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Uxbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Valley East",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vankleek Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vaughan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vineland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walkerton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wallaceburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wasaga Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterdown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterloo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wawa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Welland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wellesley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wellington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Lorne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wheatley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitchurch-Stouffville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wiarton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wikwemikong",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willowdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Windsor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wingham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodstock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wyoming",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Oregon",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Albany",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aloha",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Altamont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arleta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Astoria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baker City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beaverton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bend",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cave Junction",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedar Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedar Mill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Central Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "City of The Dalles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coos Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corvallis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Creswell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dallas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Donald",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eugene",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Four Corners",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gladstone",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glide",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grants Pass",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gresham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hayesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hazelwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hermiston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hood River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hubbard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "John Day",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jordan Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Keizer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Klamath Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Grande",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Oswego",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lebanon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincoln",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacMinnville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milwaukie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newberg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Bend",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oatfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "OBrien",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ontario",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oregon City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pendleton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riddle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "River Road",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roseburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sherwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sublimity",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sutherlin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Talent",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tigard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Troutdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tualatin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Turner",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vaughn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Linn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilsonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodburn",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Pennsylvania",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Akron",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aliquippa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Allentown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Altoona",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ambler",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amityville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ardmore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Audubon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Back Mountain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baldwin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bangor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beaver Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belle Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bensalem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berwick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Berwyn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bethel Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bethlehem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boyertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bradford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brentwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bridgeport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bristol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brockway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Broomall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bushkill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Butler",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camp Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canonsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carbondale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carlisle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carnegie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carnot Moon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chambersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chester Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarks Summit",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coatesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colonial Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conshohocken",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coraopolis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cranberry Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cresco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Croydon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dallas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dallastown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Darby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Darby Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Downingtown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Drexel Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Duncansville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dunmore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Norriton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Stroudsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Easton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Economy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edinboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elizabethtown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elkins Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Emmaus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ephrata",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Erdenheim",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Erie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Erwinna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Exton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Feasterville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Folcroft",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frederick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fullerton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Furlong",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gettysburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gibsonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glenside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gordonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greensburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gwynedd",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hampden Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harleysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrisburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrison Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hatboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haverford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Havertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hazleton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hermitage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hershey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hollidaysburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Horsham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntingdon Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Indiana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Irvine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ivyland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jeannette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jefferson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jenkintown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Johnstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kempton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kennett Square",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "King of Prussia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kutztown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lafayette Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lancaster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Landenberg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Langhorne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lansdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lansdowne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lansford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laurys Station",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lebanon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lehighton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Levittown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincoln University",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Linesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Linwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lower Burrell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lower Merion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacCandless Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacKeesport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Malvern",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Meadville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mechanicsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Media",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Merion Station",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middleburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mifflinville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milanville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monessen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moscow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Carmel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Lebanon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mountville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Munhall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Municipality of Monroeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Municipality of Murrysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "N. Charleroi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nanticoke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Narberth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Natrona Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nazareth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nether Providence Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Buffalo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Carlisle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Castle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Cumberland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Hope",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Kensington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newtown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norristown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North East",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Versailles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Wales",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oaks",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oil City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olyphant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orrtanna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orwigsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oxford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paoli",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parksburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Penn Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Philadelphia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Phildelphia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Phoenixville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pipersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pittsburgh",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasantville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plum",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pocono Summit",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pottstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pottsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Primos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Progress",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Prospect",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Quakertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Radnor Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reading",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Robinson Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roseto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ross Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Royersford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Marys",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sarver",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saxonburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scott Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scranton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seward",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sewickley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shaler Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sharon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shermans Dale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Somerset",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Souderton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Park Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "State College",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Strasburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Susquehanna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Swissvale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tamaqua",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Taylor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Telford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trevose",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Turtle Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tyrone",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Uniontown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Upper Darby",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Upper Providence Township",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Upper Saint Clair",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vanderbilt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warminster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warren",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warrendale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waverly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wayne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waynesboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Chester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Mifflin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Norriton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wexford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitehall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilcox",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilkes-Barre",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wilkinsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Williamsport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Willow Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Womelsdorf",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodlyn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woolrich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wyncote",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wyndmoor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wynnewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yardley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yeadon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "York",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Ramey",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Ramey",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Rhode Island",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Barrington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bristol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burrillville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Central Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charlestown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coventry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cranston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cumberland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Greenwich",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Providence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glocester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hopkinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Johnston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincoln",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middletown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Narragansett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Kingstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Providence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Smithfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pawtucket",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portsmouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Providence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Scituate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smithfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Kingstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tiverton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warren",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warwick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Warwick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westerly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woonsocket",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "South Carolina",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Aiken",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anderson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beaufort",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bluffton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cayce",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charleston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clemson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Easley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Florence",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest Acres",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Mill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gaffney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goose Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hanahan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hilton Head Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Irmo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lexington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mauldin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Pleasant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Myrtle Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newberry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Augusta",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Charleston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Myrtle Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orangeburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Royal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rock Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Simpsonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spartanburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Summerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sumter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Columbia",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "South Dakota",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Aberdeen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belle Fourche",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Box Elder",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brandon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookings",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrisburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huron",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mitchell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pierre",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rapid City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sioux Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spearfish",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sturgis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vermillion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yankton",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Sublimity",
                        "available" => 1,
                        "citiesInfo" => []
                    ],
                    [
                        "name" => "Tennessee",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Adamsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alcoa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Antioch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Athens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bartlett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bell Buckle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bloomingdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blountville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brentwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bristol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brownsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burns",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chattanooga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarksville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cleveland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Collierville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cookeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cornersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crossville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dayton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dickson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dyersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Brainerd",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elizabethton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farragut",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gainesboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gallatin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gatlinburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Germantown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goodlettsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greeneville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hendersonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hixson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jackson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Johnson City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingsport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Knoxville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kodak",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Vergne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lawrenceburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lebanon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lenoir City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewisburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacMinnville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Maryville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Memphis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middle Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morristown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mulberry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Murfreesboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nashville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ooltewah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pinson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Red Bank",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Selmer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sevierville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelbyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smithville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smyrna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spring City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tazewell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Trenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tullahoma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Union City",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Texas",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Abilene",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Addison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alamo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aldine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alice",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Allen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alvin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Amarillo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anderson Mill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Andrews",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Angleton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Argyle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aspermont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Atascocita",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Athens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Austin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Austinn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "austinn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Azle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Balch Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Barry",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bay City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baytown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beaumont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bedford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beeville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellaire",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Belton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Benbrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Big Spring",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bluff Dale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Boerne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Borger",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Breckenridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brenham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brownfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brownsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brownwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bryan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Buda",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burkburnett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burleson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Campbell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canyon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canyon Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carrollton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cat Spring",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedar Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedar Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Celina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Channelview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "City of Dallas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cleburne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cloverleaf",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clute",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "College Station",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colleyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Columbus",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Comanche",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Conroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Converse",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Coppell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Copperas Cove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corinth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corpus Christi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Corsicana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cotulla",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Crandall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cypress",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dallas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dayton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deer Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Del Rio",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Denison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Denton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "DeSoto",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dickinson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Donna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dumas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Duncanville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eagle Pass",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edinburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Campo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "El Paso",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elmendorf",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ennis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Euless",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmers Branch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Flower Mound",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forest Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Forney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Bliss",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Hood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Worth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Freeport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Friendswood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Frisco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gainesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Galena Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Galveston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Garland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gatesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Georgetown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Prairie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grandview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grapeland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grapevine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gregory",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Groves",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Haltom City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harker Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harlingen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Henderson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hereford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hewitt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highland Village",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hillsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Houston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Humble",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ingleside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Irving",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jacksonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jefferson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jollyville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Justin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Katy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kaufman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Keller",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kemah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kemp",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kerrville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kilgore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Killeen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Marque",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Porte",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lackland Air Force Base",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lago Vista",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Jackson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lamesa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lampasas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lancaster",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laredo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "League City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leon Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Levelland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewisville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Liberty Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lindsay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Little Elm",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Live Oak",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Llano",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lockhart",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Longview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lubbock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lufkin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lumberton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacAllen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacKinney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Magnolia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Malakoff",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mansfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marshall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "McAllen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "McKinney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medina",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mercedes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mesquite",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Midland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mineral Wells",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mission",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mission Bend",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Missouri City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montgomery",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Pleasant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Murphy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nacogdoches",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nederland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Braunfels",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Caney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Richland Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Zulch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Odessa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ovalo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Palestine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pampa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paris",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pasadena",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pearland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pecan Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pecos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pflugerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pharr",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pinehurst",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plainview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plano",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pontotoc",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Arthur",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Lavaca",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Neches",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pottsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Princeton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richardson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rio Grande City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Robstown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rockwall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rosenberg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Round Rock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rowlett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Royse City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sachse",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saginaw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Angelo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Antonio",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Benito",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Juan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "San Marcos",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santa Fe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Schertz",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seabrook",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seagoville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seguin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sherman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Slaton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Smithville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Snyder",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Socorro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Houston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Padre Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Southlake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spring",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stafford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stephenville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Strawn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sugar Land",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sulphur Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sweetwater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Taylor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Temple",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Terrell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Texarkana",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Texas City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "The Colony",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "The Woodlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tomball",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tyler",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Universal City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "University Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Uvalde",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Victoria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vidor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watauga",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waxahachie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weatherford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weslaco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Odessa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West University Place",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Settlement",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wichita Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winnsboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wylie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yoakum",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Trimble",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Bedford Kentucky",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Utah",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Alpine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "American Fork",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bluffdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bountiful",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brigham City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Canyon Rim",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Castle Dale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedar City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Centerville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clearfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clinton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cottonwood Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cottonwood West",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Draper",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Millcreek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Farmington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Holladay-Cottonwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ivins",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kaysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kearns",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Layton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lehi",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Logan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Magna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mapleton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Midvale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Millcreek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moab",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monticello",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Murray",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Logan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Ogden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ogden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Panguitch",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Park City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Payson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasant Grove",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Provo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint George",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salt Lake City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sandy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santaquin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Santaquin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Jordan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Ogden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Salt Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spanish Fork",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Taylorsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tooele",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tremonton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Union",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Jordan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Valley City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woods Cross",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Vermont",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Barre",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bennington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brattleboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bristol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cabot",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Danville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dorset",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dummerston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Corinth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Fairfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Randolph",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Essex",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Essex Junction",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grand Isle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hartford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jericho",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manchester Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middlebury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montpelier",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Putney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Randolph",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rochester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rutland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Albans",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Johnsbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saxtons River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Burlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Strafford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Townshend",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tunbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Van",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wallingford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watisfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Brookfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Charleston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Newbury",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Williston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winooski",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Virginia",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Abingdon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alexandria",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Annandale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Aylett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bailey's Crossroads",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blacksburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bluefield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bon Air",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bristol",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cave Spring",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Centreville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chantilly",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charlottesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chesapeake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Christiansburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Churchville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clifton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colonial Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Culloden",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dale City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Danville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dublin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eagle Rock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Highland Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Faber",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairfax",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Falls Church",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fishersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Hunt",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franconia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fredericksburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Front Royal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gainesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glen Allen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gloucester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goochland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Great Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Groveton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hampton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harrisonburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Henrico",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Herndon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Highland Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hollins",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hopewell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hybla Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Idylwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Irvington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jamesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jefferson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Keen Mountain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Keswick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Ridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laurel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Leesburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lincolnia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lorton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lynchburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "MacLean",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manassas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marion",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Martinsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mclean",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mechanicsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Melfa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Midlothian",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montclair",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Montross",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newport News",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Norfolk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oakton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orange",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Petersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Poquoson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portsmouth",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Radford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Roanoke",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rose Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salem",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seaford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Boston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stafford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Staffordshire",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Staunton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sterling",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Suffolk",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sugarland Run",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tappahannock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Timberlake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Triangle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tuckahoe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tysons Corner",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vienna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Virginia Beach",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Warrenton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waynesboro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Springfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Williamsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Winchester",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wolf Trap",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodbridge",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wytheville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yorktown",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Washington",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Aberdeen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Airway Heights",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Alderwood Manor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Anacortes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Arlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Auburn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bainbridge Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Battle Ground",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellevue",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bellingham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bingen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Blaine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bothell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bremerton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bryn Mawr-Skyway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Buckley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burien",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camano Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Camas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cascade-Fairwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Centralia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chehalis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cheney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clear Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Colbert",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cottage Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Covington-Sawyer-Wilderness",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Des Moines",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Duvall",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Hill-Meridian",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Renton Highlands",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "East Wenatchee Bench",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eastsound",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eatonville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edgewood-North Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Edmonds",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elk Plain",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ellensburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Enumclaw",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Esperance",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Everett",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evergreen",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairchild",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Federal Way",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ferndale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fircrest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Lewis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Friday Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gig Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Graham",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Harbour Pointe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Inglewood-Finn Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Issaquah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kelso",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kenmore",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kennewick",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kent",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kingsgate",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kirkland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lacey",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lake Serene-North Lynnwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeland North",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakeland South",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lakewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Longview",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lynnwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Martha Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mercer Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Minnehaha",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moses Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mossyrock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Vernon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mountlake Terrace",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mukilteo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Newport Hills",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North City-Ridgecrest",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "North Marysville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Harbor",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ocean Shores",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Olympia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Opportunity",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orchards South",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orting",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Paine Field-Lake Stickney",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parkland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pasco",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Picnic Point-North Lynnwood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pine Lake",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Angeles",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Hadlock",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Ludlow",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Orchard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Poulsbo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pullman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Puyallup",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Redmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Renton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Republic",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Richland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverton-Boulevard Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sahalee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Salmon Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sammamish",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "SeaTac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seattle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Seattle Hill-Silver Firs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sedro Woolley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shelton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shoreline",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Silverdale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Snohomish",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Prairie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Seattle",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spanaway",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spokane",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sumas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sumner",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sunnyside",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tacoma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tukwila",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tumwater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "University Place",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vancouver",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vashon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Walla Walla",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washougal",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wenatchee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Lake Stevens",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Center",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Salmon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "White Swan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Woodinville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yakima",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Yelm",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "West Virginia",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Beckley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bluefield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Bridgeport",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Buckhannon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charles Town",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Charleston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Clarksburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Dunbar",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elkins",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fairmont",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grafton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Huntington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hurricane",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Keyser",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lewisburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Martinsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Morgantown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Moundsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Martinsville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Nitro",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Hill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Parkersburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Point Pleasant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Princeton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ranson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ravenswood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Charleston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "St. Albans",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Summersville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Vienna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weirton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Westover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wheeling",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Wisconsin",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Adams",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Allouez",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Appleton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Ashwaubenon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Baraboo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beaver Dam",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Beloit",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brookfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Brown Deer",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Burlington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Caledonia",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Carter",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cedarburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Chippewa Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cudahy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "De Pere",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Deer Park",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Delafield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Eau Claire",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elkhorn",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Elroy",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fitchburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fond du Lac",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Fort Atkinson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Franklin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Galesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Germantown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glen Flora",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Glendale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Goodman",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Grafton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Green Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greendale",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Greenfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hartford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hartland",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Howard",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Hudson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Janesville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jefferson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Junction City",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kaukauna",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kenosha",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kiel",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Kohler",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "La Crosse",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Little Chute",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Madison",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Manitowoc",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marinette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Marshfield",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Medford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Menasha",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Menomonee Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Menomonie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mequon",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Merrill",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Middleton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Milwaukee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mineral Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Monroe",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mount Pleasant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Mukwonago",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Muskego",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Neenah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Berlin",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "New Richmond",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oak Creek",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oconomowoc",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Onalaska",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Orfordville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Oshkosh",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pigeon Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Platteville",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pleasant Prairie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Plover",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Port Washington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Portage",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Pound",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Racine",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Reedsburg",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rhinelander",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "River Falls",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Saint Francis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sheboygan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Shorewood",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "South Milwaukee",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Spring Valley",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stevens Point",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Stoughton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Strum",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sturtevant",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sun Prairie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Superior",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Three Lakes",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Tomah",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Two Rivers",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Washington Island",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waterford",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Watertown",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waukesha",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Waupun",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wausau",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wautoma",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wauwatosa",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Allis",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "West Bend",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Weston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitefish Bay",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Whitewater",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Wisconsin Rapids",
                                "locationsInfo" => []
                            ]
                        ]
                    ],
                    [
                        "name" => "Wyoming",
                        "available" => 1,
                        "citiesInfo" => [
                            [
                                "name" => "Buffalo",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Casper",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cheyenne",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Cody",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Douglas",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Evanston",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Gillette",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Green River",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Jackson",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Lander",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Laramie",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Powell",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rawlins",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Riverton",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Rock Springs",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Sheridan",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Torrington",
                                "locationsInfo" => []
                            ],
                            [
                                "name" => "Worland",
                                "locationsInfo" => []
                            ]
                        ]

                    ]
                ]
            ]
        ];
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($data as $countryInfo) {
                $country = Country::find()->where(['name' => $countryInfo['name']])->one();
                if (empty($country))
                    $country = new Country();
                if ($country->load($countryInfo, '') and $country->save()) {
                    $this->success("Country {$country->name} has been created");
                    foreach ($countryInfo['statesInfo'] as $stateInfo) {
                        $state = State::find()->where(['name' => $stateInfo['name']])->one();
                        if (empty($state))
                            $state = new State();
                        $state->country_id = $country->id;
                        if ($state->load($stateInfo, '') and $state->save()) {
                            $this->success("State {$state->name} has been created");
                            foreach ($stateInfo['citiesInfo'] as $cityInfo) {
                                $city = City::find()->where(['name' => $cityInfo['name']])->one();
                                if (empty($city))
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
