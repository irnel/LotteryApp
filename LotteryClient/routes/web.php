<?php

// use Illuminate\Routing\Route;

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

Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

Auth::routes();

Route::get('/home', 'Home\HomeController@index')->name('home');

Route::get('/my-events', 'Event\EventController@my_events')->name('my-events');

// Redirect to home by default
Route::redirect('/', 'home');
