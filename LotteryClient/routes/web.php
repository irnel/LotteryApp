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

Route::get('/my-events', 'Event\EventController@myEvents')->name('my-events');
Route::get('/my-events/{eventId}/cards', 'Event\EventController@myEventWithCards')->name('my-event.cards');
Route::get('/events/{eventId}/available-cards', 'Event\EventController@getAvailableCards')->name('available-cards');
Route::post('/events/{eventId}/cards', 'Event\EventController@addCards')->name('cards.add');

// Api Routes
Route::get('/api/events/{eventId}/cards', 'Event\EventController@getAvailableCardsByEventId')->name('cards.show');
Route::get('/api/events/closed', 'Event\EventController@closedEvents');

Route::get('/test', 'Event\EventController@test');

// Redirect to home by default
Route::redirect('/', 'home');
