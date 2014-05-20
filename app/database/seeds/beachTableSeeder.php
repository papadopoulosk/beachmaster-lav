<?php

class beachTableSeeder extends Seeder {
    
    public function run(){
        DB::table('beaches')->delete();
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 1',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 1,
            'rate' => 1,
            'approved' => true,
            'votes' => 5,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 1,
            'rate' => 3,
            'approved' => true,
            'votes' => 2,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 3',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 1,
            'rate' => 5,
            'approved' => true,
            'votes' => 3,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 4',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 1,
            'rate' => 3,
            'approved' => true,
            'votes' => 2,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 5',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 1,
            'rate' => 6,
            'approved' => true,
            'votes' => 7,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 6',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 1,
            'rate' => 1,
            'approved' => true,
            'votes' => 4,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 7',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 1,
            'rate' => 2,
            'approved' => true,
            'votes' => 4,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 8',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 1,
            'rate' => 2,
            'approved' => true,
            'votes' => 3,
            'imagePath' => 'http://lorempixel.com/g/200/200/',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
    }
}

?>
