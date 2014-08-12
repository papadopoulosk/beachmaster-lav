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
               $table->engine = "InnoDB";
               $table->increments('id') ;
               //$table->string('title');
               $table->integer('beachId')->unsigned();
               $table->foreign('beachId')->references('id')->on('beaches')->onDelete('cascade');
               $table->text('text');
               $table->integer('rate');
               $table->tinyInteger('report')->default(0);
               $table->integer('submitted_by')->references('id')->on('users');
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
