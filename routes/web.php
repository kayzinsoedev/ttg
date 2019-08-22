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
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::post('/', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

// Route::get('/index', 'DashboardController@index');

Route::resource('job', 'JobController');
Route::get('job/{job}/restore', 'JobController@restore');

Route::get('view/{postalcode}', 'ViewController@index');
Route::post('thankyou', 'ViewController@thankyou')->name('thanks');
