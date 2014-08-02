<?php

class beachTableSeeder extends Seeder {
    
    public function run(){
        DB::table('beaches')->delete();
        
        $faker = Faker\Factory::create('en_GB');
        $faker->addProvider(new Faker\Provider\Lorem($faker));
        $faker->addProvider(new Faker\Provider\Image($faker));
        $count = 150;
        $this->command->info('Inserting '.$count.' sample records using Faker ...');
        
        for( $x=0 ; $x < $count; $x++ )
        {
            DB::table('beaches')->insert(array(
                'name' => $faker->sentence(3),
                'description' => $faker->sentence(50),
                'latitude' => strval($faker->randomFloat(6, 35,42)), //'40.194100',
                'longitude' => strval($faker->randomFloat(6, 20,26)),//'23.325849',
                'approved' => $faker->numberBetween(0, 1),
                'suggestions' => $faker->numberBetween(1, 10),
                //Nomarxia
                'prefecture_id' => $faker->numberBetween(1, 2),
                //Dimos
                'municipality_id'=> $faker->numberBetween(1,2) ,
                'imagePath' => "fake",
                'created_at' => Date("Y-m-d H:i:s"),
                'updated_at' => Date("Y-m-d H:i:s")
            ));
        }
        
//        DB::table('beaches')->insert(array(
//            'name' => 'Nea Potidea',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
//            'latitude' => '40.194100',
//            'longitude' => '23.325849',
//            'approved' => true,
//            'suggestions' => 4,
//            //Nomarxia
//            'prefecture_id' => 1,
//            //Dimos
//            'municipality_id'=> 2 ,
//            'imagePath' => '/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        
////        DB::table('beaches')->insert(array(
//            'name' => 'Nea Fokaia',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
//            'latitude' => '40.133230',
//            'longitude' => '23.403783',
//            'municipality_id'=>1,
//            'approved' => true,
//            'suggestions' => 7,
//            //Nomarxia
//            'prefecture_id' => 1,
//            //Dimos
//            'municipality_id'=> 1,
//            'imagePath' => '/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        
//        DB::table('beaches')->insert(array(
//            'name' => 'Polixrono',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
//            'latitude' => '40.016586',
//            'longitude' => '23.527379',
//            //Nomarxia
//            'prefecture_id' => 1,
//            //Dimos
//            'municipality_id'=> 3,
//            'approved' => true,
//            'suggestions' => 5,
//            'imagePath' => '/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        
//        DB::table('beaches')->insert(array(
//            'name' => 'Beach 4',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
//            'latitude' => '40.3791850111976663',
//            'longitude' => '23.772258925976562',
//            //Nomarxia
//            'prefecture_id' => 2,
//            //Dimos
//            'municipality_id'=> 4,
//            'approved' => true,
//            'suggestions' => 6,
//            'imagePath' => '/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        
//        DB::table('beaches')->insert(array(
//            'name' => 'Xanioti',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
//            'latitude' => '40.001860',
//            'longitude' => '23.576646',
//            //Nomarxia
//            'prefecture_id' => 1,
//            //Dimos
//            'municipality_id'=> 3,
//            'approved' => false,
//            'suggestions' => 4,
//            'imagePath' => '/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        
//        DB::table('beaches')->insert(array(
//            'name' => 'Peukoxori',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
//            'latitude' => '39.989860',
//            'longitude' => '23.616085',
//            //Nomarxia
//            'prefecture_id' => 1,
//            //Dimos
//            'municipality_id'=> 1,
//            'approved' => true,
//            'suggestions' => 8,
//            'imagePath' => '/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        
//        DB::table('beaches')->insert(array(
//            'name' => 'Paliouri',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
//            'latitude' => '39.966906',
//            'longitude' => '23.676252',
//            //Nomarxia
//            'prefecture_id' => 1,
//            //Dimos
//            'municipality_id'=> 1,
//            'approved' => true,
//            'suggestions' => 5,
//            'imagePath' => '/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        
//        DB::table('beaches')->insert(array(
//            'name' => 'Posidi',
//            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
//            'latitude' => '39.963773',
//            'longitude' => '23.381329',
//            //Nomarxia
//            'prefecture_id' => 1,
//            //Dimos
//            'municipality_id'=> 3,
//            'approved' => true,
//            'suggestions' => 4,
//            'imagePath' => '/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
        
    }
}

?>
