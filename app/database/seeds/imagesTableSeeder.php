<?php

class imagesTableSeeder extends Seeder {
    
    public function run() {
        DB::table('images')->delete();
        
        $count = 150;
        
        $faker = Faker\Factory::create('en_GB');
        $faker->addProvider(new Faker\Provider\Lorem($faker));
        $faker->addProvider(new Faker\Provider\Image($faker));
        $this->command->info('Inserting '.$count.' sample records using Faker ...');
        
        $table = DB::table('images');
        
        for( $x=0 ; $x<$count; $x++ )
        {            
            $table->insert(array(
            'beach_id' => $x+1,
            'imagePath'=> $faker->imageUrl(900, 500, 'nature'),//'/images/uploads/default.jpg',
            'submitted_by'=>$faker->numberBetween(1, 3),
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
            ));
        }
//        
//        $table->insert(array(
//            'beach_id'=> 1,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        
//        $table->insert(array(
//            'beach_id'=> 2,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//                
//        $table->insert(array(
//            'beach_id'=> 3,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        $table->insert(array(
//            'beach_id'=> 4,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        $table->insert(array(
//            'beach_id'=> 5,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        $table->insert(array(
//            'beach_id'=> 6,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        $table->insert(array(
//            'beach_id'=> 7,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        $table->insert(array(
//            'beach_id'=> 8,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        $table->insert(array(
//            'beach_id'=> 1,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));
//        $table->insert(array(
//            'beach_id'=> 2,
//            'imagePath'=>'/images/uploads/default.jpg',
//            'created_at' => Date("Y-m-d H:i:s"),
//            'updated_at' => Date("Y-m-d H:i:s")
//        ));

        
    }
    
}
