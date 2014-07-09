<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMunicipalityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('municipalities',function($table){
                   $table->engine = "InnoDB";
                   $table->increments('id');
                   $table->string('name')->unique();
                   $table->integer('prefecture_id')->unsigned();
                   $table->foreign('prefecture_id')->references('id')->on('prefectures')->onDelete('cascade');
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
		Schema::drop('municipalities');
	}

}
