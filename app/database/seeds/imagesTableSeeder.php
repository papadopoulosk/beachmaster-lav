<?php

class imagesTableSeeder extends Seeder {
    
    public function run() {
        DB::table('images')->delete();
        
        $table = DB::table('images');
        
        $table->insert(array(
            'beach_id'=> 1,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
        $table->insert(array(
            'beach_id'=> 2,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
                
        $table->insert(array(
            'beach_id'=> 3,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        $table->insert(array(
            'beach_id'=> 4,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        $table->insert(array(
            'beach_id'=> 5,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        $table->insert(array(
            'beach_id'=> 6,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        $table->insert(array(
            'beach_id'=> 7,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        $table->insert(array(
            'beach_id'=> 8,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        $table->insert(array(
            'beach_id'=> 1,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        $table->insert(array(
            'beach_id'=> 2,
            'imagePath'=>'/images/uploads/default.jpg',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));

        
    }
    
}
