<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

// // Route::middleware('auth:api')->get('/user', function (Request $request) {
// //     return $request->user();
// // });


// Route::middleware('auth:api')->group(function () {
//     Route::resource('todo', 'API\TodoController@store');
// });

Route::get('todos', 'TodoController@index');
Route::get('todos/{id}', 'TodoController@show');
Route::post('todos', 'TodoController@store');
Route::put('todos/{id}', 'TodoController@update');
Route::delete('todos/{id}', 'TodoController@delete');
