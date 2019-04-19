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

Route::get('/', 'HomeController@index');
Route::get('/signup', 'Auth\SignupController@create');
Route::post('/signup', 'Auth\SignupController@store');
Route::get('/login', 'Auth\AuthController@index');
Route::post('/login', 'Auth\AuthController@login');
Route::get('/logout', 'Auth\AuthController@logout');
Route::get('/home', 'HomeController@index');
Route::resource('/bookshelf', 'BookshelfController')->middleware('auth');
Route::delete('/bookshelf/{bookshelf}/book/{book}', 'BookshelfController@remove');
Route::resource('/book', 'BookController');
Route::post('/book/{book}', 'BookController@add');
Route::resource('/user', 'UserController');
Route::post('/user/{user}/like', 'UserController@like');
Route::delete('/user/{user}/like', 'UserController@unlike');
// Route::get('/bookshelf/create', 'BookshelfController@create');
// Route::post('/bookshelf', 'BookshelfController@store');
// Route::get('/bookshelf/{bookshelf}', 'BookshelfController@show');
// Route::patch('/bookshelf/{bookshelf}', 'BookshelfController@update');
