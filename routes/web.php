<?php

use Illuminate\Support\Facades\Route;
use App\Models\City;
use App\Models\Slider;

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
        return view('manage.dashboard.index');
    });

    Route::get('user/index-admin','userController@index_admin')->name("index-admin");
    Route::resource('users', 'userController');
    Route::resource('sliders','sliderController');
    Route::get('sliders/active/{id}', 'sliderController@active')->name('active_slider');
    Route::get('sliders/unactive/{id}', 'sliderController@unActive')->name('unactive_slider');
    Route::resource('airlines', 'airlineController');
    Route::resource('aircrafts', 'aircraftController');
    Route::resource('airports', 'airportController');
    Route::resource('flights', 'flightController');
    Route::resource('bookings', 'bookingController');
    Route::get('bookings/active/{id}', 'bookingController@active')->name('active_booking');
    Route::get('bookings/unactive/{id}', 'bookingController@unActive')->name('unactive_booking');
    
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
Route::get('/popular-destination', function () {
    return view('client.popular_destination.index', [
        'cities' => City::get(),
        'slider' => Slider::orderBy('id','DESC')->where('status','=',1)->take(4)->get(),
    ]);
})->name('popular_destination');