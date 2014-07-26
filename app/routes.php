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
Route::get('/', array('uses' => 'HomeController@showWelcome'));

//Route::get('details/{bid?}', array( 'uses' => 'BeachController@details'));

//Route::get('suggest/{bid?}', array( 'uses' => 'BeachController@suggest'));

//Route::get('add',array('uses'=> 'BeachController@add'));

Route::get('/report/beach/{bid}',array('uses'=> 'ReportController@beach'));
Route::get('/report/review/{bid}',array('uses'=> 'ReportController@review'));
Route::get('/report/image/{bid}',array('uses'=> 'ReportController@image'));
Route::get('/logout','AuthController@destroy');

Route::resource('beach','BeachController');
Route::resource('municipality','MunicipalityController');
Route::resource('review','ReviewController',array('only' => array('store', 'show')));
Route::resource('contact','ContactController',array('only' => array('index', 'store')));
Route::resource('about','aboutController',array('only' => array('index')));
Route::resource('image', 'ImageController',array('only' => array('store')));
Route::resource('utilities', 'UtilityController',array('only' => array('store')));
Route::resource('auth', 'AuthController',array('only' => array('index','destroy','store')));

Route::get('/admin',function(){
    return View::make('admin.index');
})->before('auth.basic');

//API redirects
Route::group(
        array(
            'prefix'=>'/api/v1'
            ),
        function(){
            Route::get('beach/all/','BeachController@beaches');
            //Route::get('beach/{bid}','BeachController@beach');
            Route::get('review/{bid?}','ReviewController@review');
            Route::get('beach/neighbors','BeachController@neighbors');
            Route::post('beach/rateup','BeachController@rateup');
            Route::post('beach/ratedown','BeachController@ratedown');
            Route::any('beach/suggest/{bid?}','BeachController@suggest');
        }
);
