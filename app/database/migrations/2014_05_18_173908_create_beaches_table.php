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
                $table->boolean('approved')->default(false);
                $table->smallInteger('suggestions')->default(0);
                $table->string('imagePath');
                $table->decimal('latitude', 18, 14);
                $table->decimal('longitude', 18, 14);
                $table->integer('municipality_id');
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
