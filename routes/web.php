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
    Route::resource('admins', 'adminController')->middleware(['role:super-admin']);

});


Route::group(['namespace'=>'Client'],function(){

    Route::get('/', 'homeController@index')->name('home');
    
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'homeController@index')->name('home');
Route::redirect('/admin', 'admin/dashboard')->name('admin');