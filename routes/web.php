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

Route::get('/places', 'App\Http\Controllers\PlaceController@index');
Route::get('/places/create', 'App\Http\Controllers\PlaceController@create');
Route::post('/places', 'App\Http\Controllers\PlaceController@store');
Route::get('/places/{place}', 'App\Http\Controllers\PlaceController@show');
Route::get('/places/{place}/edit', 'App\Http\Controllers\PlaceController@edit');
Route::put('/places/{place}', 'App\Http\Controllers\PlaceController@update');