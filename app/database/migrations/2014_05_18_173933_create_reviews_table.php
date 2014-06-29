<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
            Schema::create('reviews', function($table){
               $table->increments('id') ;
               $table->string('title');
               $table->integer('beachId');
               //$table->foreign('beachId')->references('id')->on('beaches')->onDelete('cascade');               
               $table->text('text');
               $table->integer('rate');
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
		Schema::drop('reviews');
	}

}
