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
    return " /genres <br> /genres/{genreId} <br> /radios <br> /radios/{radioId} <br> /radios/{radioId}/tracks <br> ";
});

$app->get('genres', '\App\Http\Controllers\GenreController@index');
$app->get('genres/{genreId}', '\App\Http\Controllers\GenreController@show');

$app->get('radios', '\App\Http\Controllers\RadioController@index');
$app->get('radios/{radioId}', '\App\Http\Controllers\RadioController@show');
$app->get('radios/{radioId}/tracks', '\App\Http\Controllers\RadioController@indexTracks');