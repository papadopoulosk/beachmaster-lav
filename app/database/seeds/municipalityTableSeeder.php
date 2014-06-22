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
            'prefecture'=>'Halkidiki',
            'municipality'=>'Kassandra'
        ));
        
       $geo->insert(array(
           'id'=>2,
            'prefecture'=>'Halkidiki',
            'municipality'=>'Nea Propontida'
        ));
       
       $geo->insert(array(
           'id'=>3,
            'prefecture'=>'Halkidiki',
            'municipality'=>'Aristotelis'
        ));
               
       $geo->insert(array(
           'id'=>4,
            'prefecture'=>'Nea Ionia',
            'municipality'=>'Nea Ionia'
        ));
       
    }
}

?>
