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

Route::get('get_employees', 'API\EmployeeController@getEmployees');
Route::post('store_employee', 'API\EmployeeController@store');
Route::put('update_employee', 'API\EmployeeController@update');
Route::delete('destroy_employee/{employee}', 'API\EmployeeController@destroy');