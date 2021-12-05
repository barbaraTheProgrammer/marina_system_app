<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/places', 'App\Http\Controllers\PlaceController@index')->name('placeIndex');
Route::get('/places/create', 'App\Http\Controllers\PlaceController@create')->name('placeCreate');
Route::post('/places', 'App\Http\Controllers\PlaceController@store')->name('placeStore');
Route::get('/places/{place}', 'App\Http\Controllers\PlaceController@show')->name('placeShow');
Route::get('/places/{place}/edit', 'App\Http\Controllers\PlaceController@edit')->name('placeEdit');
Route::put('/places/{place}', 'App\Http\Controllers\PlaceController@update')->name('placeUpdate');
Route::delete('/places/{place}', 'App\Http\Controllers\PlaceController@destroy')->name('placeDestroy');

Route::get('/yachts', 'App\Http\Controllers\YachtController@index')->name('yachtIndex');
Route::get('/yachts/{yacht}', 'App\Http\Controllers\YachtController@show')->name('yachtShow');

Route::get('/skippers', 'App\Http\Controllers\SkipperController@index')->name('skipperIndex');

Route::get('/traffic', 'App\Http\Controllers\TrafficController@index')->name('trafficIndex');
Route::get('/traffic/create', 'App\Http\Controllers\TrafficController@create')->name('trafficCreate');
Route::post('/traffic', 'App\Http\Controllers\TrafficController@store')->name('trafficStore');
Route::get('/traffic/{record}', 'App\Http\Controllers\TrafficController@show')->name('trafficShow');
Route::post('/traffic/create', 'App\Http\Controllers\TrafficController@checkIfExists')->name('trafficCheckIfExists');