<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportBeachTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('reportBeach',function($table){
                $table->increments('id');
                $table->integer('beach_id')->unsigned();
                $table->foreign('beach_id')->references('id')->on('beaches');//->onDelete('cascade');
                $table->text('text');
                $table->timestamps();
            });
            
            Schema::create('reportReview',function($table){
                $table->increments('id');
                $table->integer('review_id')->unsigned();
                $table->foreign('review_id')->references('id')->on('reviews');//->onDelete('cascade');
                $table->text('text');
                $table->timestamps();
            });
            
            Schema::create('reportImage',function($table){
                $table->increments('id');
                $table->integer('image_id')->unsigned();
                $table->foreign('image_id')->references('id')->on('images');//->onDelete('cascade');
                $table->text('text');
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
		Schema::drop('reportBeach');
                Schema::drop('reportReview');
                Schema::drop('reportImage');
	}

}
