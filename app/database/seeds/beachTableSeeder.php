<?php

class beachTableSeeder extends Seeder {
    
    public function run(){
        DB::table('beaches')->delete();
        
        DB::table('beaches')->insert(array(
            'name' => 'Beach 1',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque fermentum erat, eu auctor velit tincidunt a. Cras mattis adipiscing.',
            'latitude' => '40.3791820111976663',
            'longitude' => '23.772354125976562',
            'numReviews' => 2,
            'rate' => 1,
            'approved' => true,
            'votes' => 5,
            'imagePath' => 'http://lorempixel.com/g/200/200/'
        ));
    }
}

?>
