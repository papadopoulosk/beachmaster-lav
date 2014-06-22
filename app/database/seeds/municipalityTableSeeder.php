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
            'prefecture'=>'Halkidiki',
            'municipality'=>'Kassandra'
        ));
        
       $geo->insert(array(
            'prefecture'=>'Halkidiki',
            'municipality'=>'Nea Propontida'
        ));
       
       $geo->insert(array(
            'prefecture'=>'Halkidiki',
            'municipality'=>'Aristotelis'
        ));
               
       $geo->insert(array(
            'prefecture'=>'Nea Ionia',
            'municipality'=>'Nea Ionia'
        ));
       
    }
}

?>
