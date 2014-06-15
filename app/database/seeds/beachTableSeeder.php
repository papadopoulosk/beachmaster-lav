<?php

class beachTableSeeder extends Seeder {
    
    public function run(){
        DB::table('beaches')->delete();
        
        DB::table('beaches')->insert(array(
            'name' => 'Nea Potidea',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.194100',
            'longitude' => '23.325849',
            //'numReviews' => 3,
            //'rate' => 1.7,
            'approved' => true,
            'suggestions' => 4,
            //'votes' => 5,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Nea Fokaia',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.133230',
            'longitude' => '23.403783',
            //'numReviews' => 1,
            //'rate' => 3,
            'approved' => true,
            'suggestions' => 7,
            //'votes' => 2,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Polixrono',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.016586',
            'longitude' => '23.527379',
            //'numReviews' => 1,
            //'rate' => 5,
            'approved' => true,
            'suggestions' => 5,
            //'votes' => 3,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 4',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791850111976663',
            'longitude' => '23.772258925976562',
            //'numReviews' => 1,
            //'rate' => 3,
            'approved' => false,
            'suggestions' => 2,
            //'votes' => 2,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Xanioti',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.001860',
            'longitude' => '23.576646',
            //'numReviews' => 1,
            //'rate' => 6,
            'approved' => false,
            'suggestions' => 4,
            //'votes' => 7,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Peukoxori',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '39.989860',
            'longitude' => '23.616085',
            //'numReviews' => 1,
            //'rate' => 1,
            'approved' => true,
            'suggestions' => 8,
            //'votes' => 4,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Paliouri',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '39.966906',
            'longitude' => '23.676252',
            //'numReviews' => 1,
            //'rate' => 2,
            'approved' => true,
            'suggestions' => 5,
            //'votes' => 4,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Posidi',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '39.963773',
            'longitude' => '23.381329',
            //'numReviews' => 1,
            //'rate' => 2,
            'approved' => true,
            'suggestions' => 4,
            //'votes' => 3,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
    }
}

?>
