<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeachesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('beaches', function($table){
                $table->increments('id');
                $table->string('name');
                $table->text('description');
                $table->integer('numReviews');
                $table->integer('votes');
                $table->integer('rate');
                $table->boolean('approved');
                $table->string('imagePath');
                $table->float('latitude');
                $table->float('longitude');
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
            Schema::drop('beaches');
	}

}
