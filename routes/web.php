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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::get('users', 'UserController@index')->name('users.list');
    Route::get('fetch/users', 'UserController@fetch')->name('users.fetch');
    Route::get('/add/user', 'UserController@form')->name('user.form');
    Route::post('/create/user', 'UserController@create')->name('user.create');
    Route::get('/{id}/user', 'UserController@form')->name('user.edit');
    Route::post('/{id}/update/user', 'UserController@update')->name('user.update');
    Route::get('/{id}/delete/user', 'UserController@delete')->name('user.delete');

});
