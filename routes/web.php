<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'admin','namespace'=>'Manager', 'middleware'=>['auth','role:super-admin|admin']],function(){

    Route::get('/dashboard', function (){
        return view('manage.layout.app');
    });

    Route::get('user/index-admin','userController@index_admin')->name("index-admin");
    Route::resource('users', 'userController');
    Route::resource('airlines', 'airlineController');
    Route::resource('aircrafts', 'aircraftController');
    Route::resource('airports', 'airportController');
    Route::resource('flights', 'flightController');
    Route::get('/slider', 'SliderController@manage_slider')->name('slider');
    Route::get('/slider/create', 'SliderController@add_slider')->name('add_slider');
    Route::post('/slider/insert', 'SliderController@insert_slider')->name('insert_slider');
});


Route::group(['namespace'=>'Client'],function(){

    Route::get('/', 'homeController@index')->name('home');
    Route::resource('home', 'homeController');
    Route::resource('passengers', 'passengerController');
    
});

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/changePassword','HomeController@showChangePasswordForm')->name('change-password')->middleware('auth');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/booking', 'HomeController@showBookingPage')->name('booking');
Route::get('/booking/add-flight/{id}', 'HomeController@addFlight')->name('addFlight');
Route::redirect('/admin', 'admin/dashboard')->name('admin');