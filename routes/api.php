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

#region API Penelitian
//create penelitian
Route::post('/penelitian', 'PenelitianController@savePenelitian');
//list penelitian
Route::get('/penelitian', 'PenelitianController@getListPenelitian');
//get single penelitian
Route::get('/penelitian/{id}', 'PenelitianController@getSinglePenelitian');
//update penelitian
Route::put('/penelitian', 'PenelitianController@savePenelitian');
//delete penelitian
Route::delete('/penelitian/{id}', 'PenelitianController@deletePenelitian');
#endregion

#region API Kategori
//create kategori
Route::post('/kategori', 'KategoriController@saveKategori');
//list kategori
Route::get('/kategori', 'KategoriController@getListKategori');
//get single kategori
Route::get('/kategori/{id}', 'KategoriController@getSingleKategori');
//update kategori
Route::put('/kategori', 'KategoriController@saveKategori');
//delete kategori
Route::delete('/kategori/{id}', 'KategoriController@deleteKategori');
#endregion

#region API Keuangan
//list keuangan
Route::get('/keuangan', 'KeuanganController@getListKeuangan');

#rincian
//create new list rincian
Route::post('/keuangan/detail', 'KeuanganController@saveDetail');
//get rincian
Route::get('/keuangan/detail/{idPenelitian}', 'KeuanganController@getListDetail');
//get single rincian
Route::get('/keuangan/detail/{idPenelitian}/{idRincian}', 'KeuanganController@getSingleDetail');
//update single rincian
Route::put('/keuangan/detail', 'KeuanganController@saveDetail');
//delete rincian
Route::delete('/keuangan/rincian', 'KeuanganController@deleteDetail');

#log pembayaran
//create log pembayaran
Route::post('/keuangan/log', 'KeuanganController@saveLog');
//get log pembayaran
Route::get('/keuangan/log/{idPenelitian}', 'KeuanganController@getListLog');
//get single log
Route::get('/keuangan/log/{idPenelitian}/{idLog}', 'KeuanganController@getSingleLog');
//update log
Route::put('/keuangan/log', 'KeuanganController@saveLog');
//delete log
Route::delete('/keuangan/log', 'KeuanganController@deleteLog');
#endregion

#region API Inventarisasi
#master
//create alat bahan
Route::post('/inventarisasi', 'AlatBahanController@saveAlatBahan');
//get list alat bahan
Route::get('/inventarisasi', 'AlatBahanController@getListAlatBahan');
//get single alat bahan
Route::get('/inventarisasi/{idAlatBahan}', 'AlatBahanController@getSingleAlatBahan');
//edit alat bahan
Route::put('/inventarisasi', 'AlatBahanController@saveAlatBahan');
//delet alat bahan
Route::delete('/inventarisasi/{idAlatBahan}', 'AlatBahanController@deleteAlatBahan');

#logs
//create log
Route::post('/inventarisasi/log', 'AlatBahanController@saveLogs');
//get list log
Route::get('/inventarisasi/log/{idAlatBahan}', 'AlatBahanController@getListLog');
#endregion

#region API Prosedur
//create prosedur
Route::post('/prosedur', 'ProsedurController@saveProsedur');
//get prosedur
Route::get('/prosedur/{idProsedur}', 'ProsedurController@getProsedur');
#endregion