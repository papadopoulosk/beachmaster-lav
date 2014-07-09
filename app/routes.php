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

//Route::get('details/{bid?}', array( 'uses' => 'BeachController@details'));

//Route::get('suggest/{bid?}', array( 'uses' => 'BeachController@suggest'));

//Route::get('add',array('uses'=> 'BeachController@add'));

Route::get('/report/beach',array('uses'=> 'ReportController@beach'));
Route::get('/report/review',array('uses'=> 'ReportController@review'));
Route::get('/report/image',array('uses'=> 'ReportController@image'));

Route::resource('beach','BeachController');
Route::resource('municipality','MunicipalityController');
Route::resource('review','ReviewController',array('only' => array('store', 'show')));
Route::resource('image', 'ImageController',array('only' => array('store')));
Route::resource('utilities', 'UtilityController',array('only' => array('store')));


//API redirects
Route::group(
        array(
            'prefix'=>'/api/v1'
            ),
        function(){
            Route::get('beach/all/{area?}','BeachController@beaches');
            Route::get('beach/{bid?}','BeachController@beach');
            Route::get('review/{bid?}','ReviewController@review');
            Route::post('beach/neighbors','BeachController@neighbors');
            Route::post('beach/rateup','BeachController@rateup');
            Route::post('beach/ratedown','BeachController@ratedown');
            Route::any('beach/suggest/{bid?}','BeachController@suggest');
        }
);
