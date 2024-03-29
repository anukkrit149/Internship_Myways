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

Route::get('/', 'MainController@index');
Route::post('/checklogin','MainController@checklogin');
Route::get('/success','MainController@success');
Route::get('/logout','MainController@logout');
Route::get('/reg','RegController@index');
Route::post('/reg/createUser','RegController@createUser');
Route::get('/dashboard','Dashboard@index');
Route::get('/forgotpass','forgotPass@index');
Route::post('/forgotpass/recover','forgotPass@recover');

