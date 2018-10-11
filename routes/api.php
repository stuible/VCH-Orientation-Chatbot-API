<?php

use Illuminate\Http\Request;
Use App\Intent;

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

// INTENTS

//All Intents
Route::get('intents', 'IntentController@index');

//Single Intent
Route::get('intents/{name}', 'IntentController@show');

//Create Intent
Route::post('intents', 'IntentController@store');

//Create Intent
Route::put('intents/{name}', 'IntentController@store');

//Destroy Intent
Route::delete('intents/{name}', 'IntentController@destroy');




// SLOTS

//All Intents
Route::get('intents/{intent}/slots', 'SlotController@index');

//Single Intent
Route::get('intents/{intent}/slots/{slot}', 'SlotController@show');

//Create Intent
Route::post('intents/{intent}/slots', 'SlotController@store');

//Create Intent
Route::put('intents/{intent}/slots/{name}', 'SlotController@store');

//Destroy Intent
Route::delete('intents/{intent}/slots/{name}', 'SlotController@destroy');
