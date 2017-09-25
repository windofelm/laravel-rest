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

Route::get('/sample', function (){
    dd(\App\User::find(1)->toArray());
});
Route::post('/api/authenticate', 'AuthenticateController@authenticate');
Route::post('/api/get-user', 'AuthenticateController@getAuthenticatedUser');

//Route::group(['middleware' => 'auth.basic'], function () {

Route::middleware(['jwt.auth'])->group(function(){
    Route::get('/api/books', 'BookController@index');
    Route::get('/api/books/{id}', 'BookController@show');
    Route::post('/api/books', 'BookController@store');
    Route::put('/api/books/{id}', 'BookController@update');
    Route::delete('/api/books/{id}', 'BookController@destroy');
});
