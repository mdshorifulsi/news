<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('layouts');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('homepage');

Route::group(['namespace' => 'App\Http\Controllers'], function () {

  Route::get('english', 'LanguageController@english')->name('language.english');
  Route::get('bangla', 'LanguageController@bangla')->name('language.bangla');

});



Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {

  Route::get('/post_details/{id}', 'PostController@post_details')->name('post_details');
  Route::get('/categorypost/{id}', 'PostController@categorypost')->name('categorypost');


});