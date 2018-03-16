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
    return view('home');
});

Auth::routes();
Route::post('register', 'Auth\RegisterController@register'); 


Route::get('/home', 'HomeController@index')->name('home');

Route::get('dishwashers', 'ApplianceController@dishwashers')->name('dishwashers');
Route::get('small-appliances', 'ApplianceController@smallAppliances')->name('small.appliances');
Route::get('wishes', 'WisheslistController@wishesListUser')->name('wishesListUser');

Route::post('{userId}/wishlist/control_appliance', 'WisheslistController@addRemoveAppliance')->name('wisheslist.addRemove.appliance');
Route::post('{userId}/wishlist/remove-appliance', 'WisheslistController@removeAppliance')->name('wisheslist.remove.appliance');