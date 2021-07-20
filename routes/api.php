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

Route::get('password', function(){
    return bcrypt('putu');
});

//Buku
Route::get('buku','API\BukuController@index');
Route::get('buku/{id}','API\BukuController@show');
Route::post('buku','API\BukuController@store');
Route::patch('buku/{id}','API\BukuController@update');
Route::delete('buku/{id}','API\BukuController@destroy');

//Peminjam
Route::get('pinjam','API\PeminjamController@index');
Route::get('pinjam/{id}','API\PeminjamController@show');
Route::post('pinjam','API\PeminjamController@store');
Route::patch('pinjam/{id}','API\PeminjamController@update');
Route::delete('pinjam/{id}','API\PeminjamController@destroy');

//Login
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('wajib', 'AuthController@wajib');
});