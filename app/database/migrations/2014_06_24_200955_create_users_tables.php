<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
                {
                    $table->increments('id');
                    $table->engine = "InnoDB";
                    $table->string('name');
                    $table->string('publicName')->default(null);
                    $table->string('email')->unique();
                    $table->string('serviceCode')->default(null);
                    $table->string('password',60)->default(null);
                    $table->string('image')->nullable()->default(null);
                    $table->tinyInteger('showImage',null);
                    $table->string('remember_token',100)->nullable();
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
                Schema::drop('users');
	}

}
