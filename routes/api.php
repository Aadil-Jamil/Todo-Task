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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH ROUTES
Route::post('/login', 'Api\AuthController@login');
Route::post('/verify', 'Api\AuthController@verify');
Route::post('/register', 'Api\AuthController@register');

Route::resource('users', 'Api\UserController');
Route::resource('todos', 'Api\TodoController');
