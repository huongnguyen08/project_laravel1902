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
// Route::get('login', 'PageController@getLogin');
// Route::post('login', 'PageController@login');

// Route::get('login', 'PageController@login');
// Route::get('login', 'PageController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// php artisan make:auth
// php artisan route:list