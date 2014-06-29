<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of municipalityTableSeeder
 *
 * @author konos
 */
class municipalityTableSeeder extends Seeder{
    
    public function run(){
        DB::table('municipalities')->delete();
        
        $geo = DB::table('municipalities');
        
        $geo->insert(array(
            'id'=>1,
            'prefecture_id'=> 1,
            'name'=>'Kassandra'
        ));
        
       $geo->insert(array(
            'id'=> 2,
            'prefecture_id'=> 1,
            'name'=>'Nea Propontida'
        ));
       
       $geo->insert(array(
            'id'=>3,
            'prefecture_id'=> 1,
            'name'=>'Aristotelis'
        ));
               
       $geo->insert(array(
            'id'=>4,
            'prefecture_id' => 2,
            'name' => 'Nea Ionia'
        ));
       
    }
}

?>
