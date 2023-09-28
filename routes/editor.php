<?php


use Illuminate\Support\Facades\Route;


Route::group(['as' => 'editor.', 'prefix' => 'editor', 'namespace' => 'App\Http\Controllers\Editor', 'middleware' => ['auth', 'editor']], function () {

    Route::get('dashboard', 'EditorDashboardController@index')->name('dashboard');
    Route::get('/post', 'PostController@index')->name('post.index');
    Route::get('/create-post', 'PostController@create')->name('post.create');
    Route::post('/store-post', 'PostController@store')->name('post.store');
    Route::get('/delete-post{id}', 'PostController@destroy')->name('post.delete');
    Route::get('/edit-post{id}', 'PostController@edit')->name('post.edit');
    Route::post('/update-post{id}', 'PostController@update')->name('post.update');
    Route::get('/view-post{id}', 'PostController@view')->name('post.view');



});