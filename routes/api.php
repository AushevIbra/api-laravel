<?php

use Illuminate\Http\Request;

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
Route::get('/clients/list', 'ClientController@listClients');
Route::get('/foods/list', 'FoodController@foodList');
Route::resources([
    'clients' => 'ClientController',
    'foods'   => 'FoodController',
    'orders'  => 'OrderController',
]);

Route::get('/stats', 'OrderController@stats');

