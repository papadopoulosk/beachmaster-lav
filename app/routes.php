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

//Route::get('suggest/{bid?}', array( 'uses' => 'BeachController@suggest'));

Route::get('add',array('uses'=> 'BeachController@add'));

Route::post('add',array('uses'=> 'BeachController@addBeach'));

Route::post('review/add', array( 'uses' => 'ReviewController@add'));

Route::get('/about', array(
    'before'=>'welcome',
    function()
    {
	return View::make('beach.about');
    }
));

//API redirects
Route::group(array('prefix'=>'/api/v1'),function(){
    Route::resource('beach/all','BeachController@beaches');
    Route::resource('review/{bid?}','ReviewController@review');
    Route::resource('beach/neighbors','BeachController@neighbors');
    Route::resource('beach/rateup','BeachController@rateup');
    Route::resource('beach/ratedown','BeachController@ratedown');
    //Route::resource('beach/suggest/{bid?}','BeachController@suggest');
});
