<?php

use Illuminate\Http\Request;
use App\Appliance;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\RegisterController@register'); 

Route::get('appliances', 'ApplianceController@index');

Route::get('appliances/{id}', 'ApplianceController@show');

Route::post('appliances', 'ApplianceController@store');

Route::put('appliances/{id}', 'ApplianceController@update');

/*
Route::get('appliances', function() {
	return Appliance.all();
});

Route::get('appliance/{id}', function($id) {
	return Appliance::find($id);
});

Route::post('appliances', function(Request $request) {
	return Appliance::create($request->all);
});

Route::put('appliances/{id}', function(Request $request, $id) {
	$appliance = Appliance::findOrFail($id);
	$appliance->update($request->all());
	return $appliance;
});
*/