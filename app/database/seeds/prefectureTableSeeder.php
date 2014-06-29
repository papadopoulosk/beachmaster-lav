<?php

class prefectureTableSeeder extends Seeder {
    
    public function run(){
        DB::table('prefectures')->delete();
        
        $table = DB::table('prefectures');
        
        $table->insert(array(
            'id'=>1,
            'name'=>'Halkidiki'
        ));
               
        $table->insert(array(
            'id'=>2,
            'name'=>'Nea Ionia'
        ));
    }
}

?>
