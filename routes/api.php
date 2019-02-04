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

//API Penelitian
//list penelitian
Route::get('/penelitian', 'PenelitianController@index');
//get single penelitian
Route::get('/penelitian/{id}', 'PenelitianController@show');
//create penelitian
Route::post('/penelitian', 'PenelitianController@store');
//update penelitian
Route::put('/penelitian', 'PenelitianController@store');
//delete penelitian
Route::delete('/penelitian/{id}', 'PenelitianController@destroy');

//API Inventarisasi
//list alat bahan
Route::get('/inventarisasi', 'AlatBahanController@index');
//get single alat bahan
Route::get('/inventarisasi/{id}', 'AlatBahanController@show');
//create alat bahan
Route::post('/inventarisasi', 'AlatBahanController@store');
//update alat bahan
Route::put('/inventarisasi', 'AlatBahanController@store');
//delete alat bahan
Route::delete('/inventarisasi/{id}', 'AlatBahanController@destroy');
//transaksi alat bahan
Route::post('/inventarisasi/transaksi', 'AlatBahanController@createTrx');
//log transaksi
Route::get('inventarisasi/transaksi/{idAlatBahan}', 'AlatBahanController@logTrx');