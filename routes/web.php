<?php

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

Auth::routes();

Route::get('', 'UserController@index');
Route::get('/', 'UserController@index');
Route::get('/index', 'UserController@index');

Route::get('/home', 'HomeController@index');

Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');

Route::get('index', 'UserController@index')->name('index');
Route::get('/show/{id}', 'UserController@show');

Route::get('/annonce/index', 'AnnonceController@index')->name('annonce/index');
Route::get('/annonce/search', 'AnnonceController@search')->name('annonce/search');
Route::post('/annonce/search', 'AnnonceController@index');


Route::group(['middleware' => 'auth'], function() {
    Route::get('/annonce/new', 'AnnonceController@showNews');
    Route::post('/annonce/new', 'AnnonceController@news')->name('annonce/new');

    Route::get('/annonce/edit/{id}', 'AnnonceController@showEdit');
    Route::post('/annonce/edit/{id}', 'AnnonceController@edit');

    Route::get('/message/send', 'messageController@index');
    Route::post('/message/send', 'messageController@send');

    Route::get('/message/reception', 'messageController@reception');

    Route::get('/annonce/delete/{id}', 'AnnonceController@delete'); 

    Route::post('user/update', 'UserController@store')->name('update');
    Route::get('user/delete', 'UserController@destroy')->name('delete');
});