<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('utilities',function($table){
                    $table->increments('id');
                    $table->integer('beach_id')->unique();
                    $table->boolean('hasBeachbar');
                    $table->boolean('hasShade');
                    $table->boolean('hasFreeParking');
                    $table->boolean('hasPaidParking');
                    $table->boolean('hasRoadAccess');
                    $table->boolean('hasWifi');
                    $table->boolean('hasSand');
                    $table->boolean('hasFreeSunbed');
                    $table->boolean('hasPaidSunbed');
                    $table->boolean('hasFreeUmbrella');
                    $table->boolean('hasPaidUmbrella');
                    $table->timestamps();
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('utilities');
	}

}
