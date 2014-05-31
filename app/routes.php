<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', array('uses' => 'BeachController@index'));

Route::get('details/{bid?}', array( 'uses' => 'BeachController@details'));

Route::get('/about', function()
{
	return View::make('beach.about');
});

Route::group(array('prefix'=>'api/v1'),function(){
    Route::resource('beaches','BeachController@beaches');
});