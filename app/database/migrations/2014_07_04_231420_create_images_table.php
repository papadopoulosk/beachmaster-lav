<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('images',function($table){
                    $table->engine = "InnoDB";
                    $table->increments('id');
                    $table->integer('beach_id')->unsigned();
                    $table->foreign('beach_id')->references('id')->on('beaches')->onDelete('cascade');
                    $table->string('imagePath');
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
		Schema::drop('images');
	}

}
