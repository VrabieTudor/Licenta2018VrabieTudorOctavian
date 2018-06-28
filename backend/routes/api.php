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

Route::get('/images/{entity}/{path}', 'ImageController@show')->where('path', '.*');
Route::resource('files', 'FileController', [
    'only' => ['store', 'update', 'show', 'destroy'],
    'parameters' => ['files' => 'file']
]);
//Route::get('user-permissions/count', 'UserPermissionController@count');
//Route::get('user-permissions/export', 'UserPermissionController@export');
//Route::resource('user-permissions', 'UserPermissionController', [
//    'only' => ['index', 'store', 'show', 'update', 'destroy'],
//    'parameters' => ['user-permissions' => 'userPermission']
//]);
//
//Route::get('user-types/count', 'UserTypeController@count');
//Route::get('user-types/export', 'UserTypeController@export');
//Route::resource('user-types', 'UserTypeController', [
//    'only' => ['index', 'store', 'show', 'update', 'destroy'],
//    'parameters' => ['user-types' => 'userType']
//]);
//
//Route::get('users/count', 'UserController@count');
//Route::get('users/showByComp/{companyId}', 'UserController@showUserByComp');
//Route::get('users/me', 'UserController@me');
//Route::get('users/export', 'UserController@export');
//Route::resource('users', 'UserController', [
//    'only' => ['index', 'store', 'show', 'update', 'destroy'],
//    'parameters' => ['users' => 'user']
//]);
Route::resource('flights', 'FlightController', [
    'only' => ['index', 'store', 'show', 'update', 'destroy'],
    'parameters' => ['flights' => 'flight']
]);

Route::get('/search', 'FlightSearchController@index');
Route::get('/cities', 'CityController@index');
Route::get('/places', 'PlaceController@index');

