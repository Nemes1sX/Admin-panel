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
Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
        Route::get('users/edit/{id}', 'UserController@edit')->middleware('isAdmin');
        Route::post('users/update/{id}','UserController@update')->middleware('isAdmin');
        Route::delete('users/delete/{id}', 'UserController@delete')->middleware('isAdmin');
        Route::post('users/create', 'UserController@create')->middleware('isAdmin');
        Route::get('users', 'UserController@index')->middleware('isAdminOrSelf');
        Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    });   
});
Route::prefix('tasks')->group(function(){
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/', 'TaskController@index')->middleware('isAdminOrSelf');
        Route::post('add', 'TaskController@add')->middleware('isAdmin');
        Route::get('show/{id}', 'TaskController@show')->middleware('isAdminOrSelf');
        Route::get('edit/{id}', 'TaskController@edit')->middleware('isAdminOrSelf');
        Route::post('update/{id}', 'TaskController@update')->middleware('isAdminOrSelf');
        Route::delete('delete/{id}', 'TaskController@delete')->middleware('isAdmin');
    });
}); 