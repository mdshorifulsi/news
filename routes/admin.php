<?php

use Illuminate\Support\Facades\Route;


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'admin']], function () {

  Route::get('dashboard', 'AdminDashboardController@index')->name('dashboard');
});


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'admin']], function () {

// Category
  Route::get('/category', 'CategoryController@index')->name('category.index');
  Route::post('/category-store', 'CategoryController@store')->name('category.store');
  Route::get('/category-delete{id}', 'CategoryController@destroy')->name('category.delete');
  Route::post('/category-update', 'CategoryController@update')->name('category.update');
  Route::get('/category/inactive/{id}', 'CategoryController@inactive');
  Route::get('/category/active/{id}', 'CategoryController@active');

  // tag

  Route::get('/tag', 'TagController@index')->name('tag.index');
  Route::post('/tag-store', 'TagController@store')->name('tag.store');
  Route::get('/tag-delete{id}', 'TagController@destroy')->name('tag.delete');
  Route::post('/tag-update', 'TagController@update')->name('tag.update');
  Route::get('/tag/inactive/{id}', 'TagController@inactive');
  Route::get('/tag/active/{id}', 'TagController@active');


  // district
  Route::get('/district', 'DistrictController@index')->name('district.index');
  Route::post('/district-store', 'DistrictController@store')->name('district.store');
  Route::get('/district-delete{id}', 'DistrictController@destroy')->name('district.delete');
  Route::post('/district-update', 'DistrictController@update')->name('district.update');

  // post

  Route::get('/post', 'PostController@index')->name('post.index');
  Route::get('/create-post', 'PostController@create')->name('post.create');
  Route::post('/store-post', 'PostController@store')->name('post.store');
  Route::get('/delete-post{id}', 'PostController@destroy')->name('post.delete');
  Route::get('/edit-post{id}', 'PostController@edit')->name('post.edit');
  Route::post('/update-post{id}', 'PostController@update')->name('post.update');
  Route::get('/view-post{id}', 'PostController@view')->name('post.view');
  Route::get('/post/inactive/{id}', 'PostController@inactive');
  Route::get('/post/active/{id}', 'PostController@active');
  Route::get('/post/big_thumbnail_no/{id}', 'PostController@big_thumbnail_no');
  Route::get('/post/big_thumbnail_yes/{id}', 'PostController@big_thumbnail_yes');
  Route::get('/post/first_section_no/{id}', 'PostController@first_section_no');
  Route::get('/post/first_section_yes/{id}', 'PostController@first_section_yes');

  //breakingnews

  Route::get('/breakingnews', 'BreakingNewsController@index')->name('breakingnews.index');
  Route::post('/store-breakingnews', 'BreakingNewsController@store')->name('breakingnews.store');
  Route::get('/delete-breakingnews{id}', 'BreakingNewsController@destroy')->name('breakingnews.delete');
  Route::post('/braking-update', 'BreakingNewsController@update')->name('braking.update');

  //namaj
  Route::get('/namaz', 'NamazController@index')->name('namaz.index');
  Route::post('/namaj-update{id}', 'NamazController@update')->name('namaj.update');

  // website
  Route::get('/website', 'websiteController@index')->name('website.index');
  Route::post('/website-store', 'websiteController@store')->name('website.store');
  Route::get('/website-delete{id}', 'websiteController@destroy')->name('website.delete');
  Route::get('/website/inactive/{id}', 'websiteController@inactive');
  Route::get('/website/active/{id}', 'websiteController@active');

  //Tv
  Route::get('/tv', 'TvController@index')->name('tv.index');
  Route::post('/tv-update{id}', 'TvController@update')->name('tv.update');


  //photo Gallery
  Route::get('/photo_gallery', 'PhotoGallaryController@index')->name('photo_gallery.index');
  Route::post('/photo_gallery-store', 'PhotoGallaryController@store')->name('photo_gallery.store');
  Route::get('/photo_gallery-delete{id}', 'PhotoGallaryController@destroy')->name('photo_gallery.delete');
  Route::get('/photo_gallery/inactive/{id}', 'PhotoGallaryController@inactive');
  Route::get('/photo_gallery/active/{id}', 'PhotoGallaryController@active');

// setting
 
  Route::get('/setting', 'SettingController@index')->name('setting.index');
  Route::post('/setting-update{id}', 'SettingController@update')->name('setting.update');

  
});