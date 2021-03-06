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
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->string('name');
                $table->string('slug');
                $table->index('slug');
                $table->text('description');
                $table->boolean('approved')->default(false);
                $table->index('approved');
                $table->smallInteger('suggestions')->default(0);
                $table->string('imagePath');
                $table->decimal('latitude', 18, 14);
                $table->decimal('longitude', 18, 14);
                $table->integer('prefecture_id')->unsigned();
                $table->integer('municipality_id')->unsigned();
                $table->foreign('prefecture_id')->references('id')->on('prefectures');//->onDelete('cascade');
                //$table->index('prefecture_id');
                $table->foreign('municipality_id')->references('id')->on('municipalities');//->onDelete('cascade');  
                //$table->index('municipality_id');
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
            Schema::drop('beaches');
	}

}
