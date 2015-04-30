<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/', function() use ($app) {
	return "Hello World";
});

$app->get('genres', '\App\Http\Controllers\GenreController@index');
$app->get('genres/{id}', '\App\Http\Controllers\GenreController@show');

$app->get('radios', '\App\Http\Controllers\RadioController@index');
$app->get('radios/{id}', '\App\Http\Controllers\RadioController@show');
$app->get('radios/{id}/tracks', '\App\Http\Controllers\RadioController@indexTracks');