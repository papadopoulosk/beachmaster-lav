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

Event::listen('illuminate.query', function($query) {
//    var_dump($query);
//    var_dump(DB::getQueryLog());
});

//Route::get('csv',function(){
//   $file = fopen(public_path().'/Beaches2.csv', 'r');
//        while (($line = fgetcsv($file)) !== FALSE) {
//        //$line is an array of the csv elements
//        print_r($line);
//    }
//    fclose($file); 
//});

//Public custom routes
Route::get('/', array('uses' => 'HomeController@showWelcome'));
Route::get('/auth/google', 'AuthController@googleauth');
Route::get('/report/beach/{bid}', array('uses' => 'ReportController@beach'));
Route::get('/report/review/{bid}', array('uses' => 'ReportController@review'));
Route::get('/report/image/{bid}', array('uses' => 'ReportController@image'));
Route::get('/logout', 'AuthController@destroy');
Route::get('/login', 'AuthController@index');
Route::get('/cdn', function() {
    return public_path();
});
//Public resources
Route::resource('beach', 'BeachController', array('except' => array('store')));
Route::resource('review', 'ReviewController', array('only' => array('show')));
Route::resource('contact', 'ContactController', array('only' => array('index', 'store')));
Route::resource('about', 'aboutController', array('only' => array('index')));
Route::resource('auth', 'AuthController', array('only' => array('index', 'destroy', 'store')));
Route::resource('profile','ProfileController');

//Resources after authorisation
Route::group(array('before' => 'auth'), function() {
    Route::get('/admin', function() {
        return View::make('admin.index');
    });
    Route::resource('beach', 'BeachController', array('only' => array('store')));
    Route::resource('utilities', 'UtilityController', array('only' => array('store')));
    Route::resource('image', 'ImageController', array('only' => array('store')));
    Route::resource('review', 'ReviewController', array('only' => array('store')));
});

//API redirects
Route::group(
        array(
    'prefix' => '/api/v1'
        ), function() {
    //Public API
    Route::get('beach/all/', 'BeachController@beaches');
    Route::get('beach/names', 'BeachController@getNames');
    Route::get('review/{bid?}', 'ReviewController@review');
    Route::get('beach/neighbors', 'BeachController@neighbors');

    //API after authorisation
    Route::group(array('before' => 'auth'), function() {
        Route::post('beach/rateup', 'BeachController@rateup');
        Route::post('beach/ratedown', 'BeachController@ratedown');
        Route::any('beach/suggest/{bid?}', 'BeachController@suggest');
        Route::post('beach/updateDescription', 'BeachController@updateDescription');
    });
}
);
