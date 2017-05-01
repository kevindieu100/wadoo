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

//Routes for LoginController
Route::get('/', 'LoginController@index'); //returns the index page
Route::post('/login', 'LoginController@login'); //post attempt to login

//Routes for UserController
Route::get('/signup', 'UserController@signUpPage'); //returns the signup page
Route::post('/user/create', 'UserController@createUser'); //post request to create a user
Route::put('/user/{id}/update', 'UserController@updateUser'); //put to update a user's info

//Routes for MainController
Route::get('/main', 'MainController@getMainPage'); //returns the main page
Route::post('/preferences', 'MainController@createItinerary'); //post with the three preferences

//Itienraries Controller
Route::post('/itineraries/save', 'ItineraryController@saveItinerary');
Route::get('/itineraries/{id}/preview', 'ItineraryController@getItinerary'); //gets the itinerary preview
Route::put('/itineraries/{id}/update', 'ItineraryController@updateItinerary'); //updates the itinerary
Route::get('/itineraries/{id}/delete', 'ItineraryController@deleteItinerary'); //deletes that itinerary
