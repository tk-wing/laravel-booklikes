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

// Route::get('/', function () {
//     return view('test.welcome');
// });
// Route::resource('/photos', 'PhotoController');

Route::get('/', 'Test\WelcomeController@index');
Route::get('/signup', 'Auth\SignupController@create');
Route::post('/signup', 'Auth\SignupController@store');
Route::get('/login', 'Auth\LoginController@index');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/home', function(){
    dd(auth()->user());
});
