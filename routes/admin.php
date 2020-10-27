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


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth:admin'], function(){
  Route::get('/', 'DashboardController@index')->name('admin.dashboard');
  //===> Start Route Languages
  Route::group(['prefix' => 'languages'], function()
  {
    Route::get('/', 'LanguagesController@index')->name('admin.languages');
    Route::get('/create', 'LanguagesController@create')->name('admin.languages.create');
    Route::post('/store', 'LanguagesController@store')->name('admin.languages.store');
    Route::get('/edit/{id}', 'LanguagesController@edit')->name('admin.languages.edit');
    Route::put('/update/{id}', 'LanguagesController@update')->name('admin.languages.update');
    Route::get('/delete/{id}', 'LanguagesController@destroy')->name('admin.languages.delete');
  });
  //===> End Route Languages

  //===> Start Route Languages
  Route::group(['prefix' => 'main_categories'], function()
  {
    Route::get('/', 'MainCategoryController@index')->name('admin.maincategories');
    Route::get('/create', 'MainCategoryController@create')->name('admin.maincategories.create');
    Route::post('/store', 'MainCategoryController@store')->name('admin.maincategories.store');
    Route::get('/edit/{id}', 'MainCategoryController@edit')->name('admin.maincategories.edit');
    Route::put('/update/{id}', 'MainCategoryController@update')->name('admin.maincategories.update');
    Route::get('/delete/{id}', 'MainCategoryController@destroy')->name('admin.maincategories.delete');
  });
  //===> End Route Languages
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'guest:admin'], function(){
    Route::get('login', 'LoginController@get_login')->name('get.admin.login');
    Route::post('login', 'LoginController@post_login')->name('admin.login');
});


