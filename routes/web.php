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

Route::get('/', function () { return view('welcome'); });
Route::get('/home', function () { return view('/home'); });

Route::group(['namespace' => 'Admin'], function()
{
    Auth::routes();
    Route::patch('/users/{user}/block', 'UserController@block');
    Route::resource('/users', 'UserController');
    Route::resource('/admins', 'AdminController');
});