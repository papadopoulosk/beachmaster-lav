<?php

class utilitiesTableSeeder extends Seeder {
    
    public function run(){
        DB::table('utilities')->delete();
        
        DB::table('utilities')->insert(array(
            'beach_id' => '1',
            'hasBeachbar' => '1',
            'hasShade' => '0',
            'hasFreeParking' => '1',
            'hasPaidParking' => '0',
            'hasRoadAccess' => '1',
            'hasWifi' => '0',
            'hasSand' => '1',
            'hasFreeSunbed' => '1',
            'hasPaidSunbed' => '0',
            'hasFreeUmbrella' => '0',
            'hasPaidUmbrella' => '1',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('utilities')->insert(array(
            'beach_id' => '2',
            'hasBeachbar' => '0',
            'hasShade' => '0',
            'hasFreeParking' => '1',
            'hasPaidParking' => '0',
            'hasRoadAccess' => '1',
            'hasWifi' => '0',
            'hasSand' => '1',
            'hasFreeSunbed' => '0',
            'hasPaidSunbed' => '1',
            'hasFreeUmbrella' => '0',
            'hasPaidUmbrella' => '1',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('utilities')->insert(array(
            'beach_id' => '3',
            'hasBeachbar' => '1',
            'hasShade' => '0',
            'hasFreeParking' => '1',
            'hasPaidParking' => '0',
            'hasRoadAccess' => '1',
            'hasWifi' => '0',
            'hasSand' => '1',
            'hasFreeSunbed' => '1',
            'hasPaidSunbed' => '0',
            'hasFreeUmbrella' => '0',
            'hasPaidUmbrella' => '1',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('utilities')->insert(array(
            'beach_id' => '4',
            'hasBeachbar' => '1',
            'hasShade' => '0',
            'hasFreeParking' => '1',
            'hasPaidParking' => '0',
            'hasRoadAccess' => '1',
            'hasWifi' => '0',
            'hasSand' => '1',
            'hasFreeSunbed' => '1',
            'hasPaidSunbed' => '0',
            'hasFreeUmbrella' => '0',
            'hasPaidUmbrella' => '1',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('utilities')->insert(array(
            'beach_id' => '5',
            'hasBeachbar' => '1',
            'hasShade' => '0',
            'hasFreeParking' => '1',
            'hasPaidParking' => '0',
            'hasRoadAccess' => '1',
            'hasWifi' => '0',
            'hasSand' => '1',
            'hasFreeSunbed' => '1',
            'hasPaidSunbed' => '0',
            'hasFreeUmbrella' => '0',
            'hasPaidUmbrella' => '1',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('utilities')->insert(array(
            'beach_id' => '6',
            'hasBeachbar' => '1',
            'hasShade' => '0',
            'hasFreeParking' => '1',
            'hasPaidParking' => '0',
            'hasRoadAccess' => '1',
            'hasWifi' => '0',
            'hasSand' => '1',
            'hasFreeSunbed' => '1',
            'hasPaidSunbed' => '0',
            'hasFreeUmbrella' => '0',
            'hasPaidUmbrella' => '1',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('utilities')->insert(array(
            'beach_id' => '7',
            'hasBeachbar' => '1',
            'hasShade' => '0',
            'hasFreeParking' => '1',
            'hasPaidParking' => '0',
            'hasRoadAccess' => '1',
            'hasWifi' => '0',
            'hasSand' => '1',
            'hasFreeSunbed' => '1',
            'hasPaidSunbed' => '0',
            'hasFreeUmbrella' => '0',
            'hasPaidUmbrella' => '1',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        DB::table('utilities')->insert(array(
            'beach_id' => '8',
            'hasBeachbar' => '1',
            'hasShade' => '0',
            'hasFreeParking' => '1',
            'hasPaidParking' => '0',
            'hasRoadAccess' => '0',
            'hasWifi' => '0',
            'hasSand' => '1',
            'hasFreeSunbed' => '1',
            'hasPaidSunbed' => '1',
            'hasFreeUmbrella' => '1',
            'hasPaidUmbrella' => '0',
            'created_at' => Date("Y-m-d H:i:s"),
            'updated_at' => Date("Y-m-d H:i:s")
        ));
        
    }
    
}

?>
