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
                //$table->integer('numReviews')->default(0);
                //$table->integer('votes')->default(0);
                //$table->double('rate',2,1)->default(null);
                $table->boolean('approved')->default(false);
                $table->smallInteger('suggestions')->default(0);
                //$table->smallInteger('likes')->default(0);
                //$table->smallInteger('dislikes')->default(0);
                $table->string('imagePath');
                $table->decimal('latitude', 18, 14);
                $table->decimal('longitude', 18, 14);
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
