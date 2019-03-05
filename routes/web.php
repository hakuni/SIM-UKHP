<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layout/index');
});
// dashboard
Route::get('/Dashboard', function () {
    return view('dashboard/index');
});

#region Penelitian
// penelitian
Route::get('/Penelitian', 'View\PenelitianController@index');
Route::get('/TambahPenelitian', 'View\PenelitianController@tambahPenelitian');
Route::get('/UbahPenelitian/{id}', 'View\PenelitianController@ubahPenelitian');
//prosedur
Route::get('/Prosedur/{idPen}/{idPro}', 'View\ProsedurController@index');
Route::get('/TambahProsedur/{idPen}', 'View\ProsedurController@tambahProsedur');
Route::get('/UbahProsedur/{idPen}/{idPro}', 'View\ProsedurController@ubahProsedur');
#endregion

#region Keuangan
// keuangan
Route::get('/Keuangan', 'View\KeuanganController@index');
Route::get('/Rincian/{id}', 'View\KeuanganController@rincian');
#endregion

#region Inventaris
// inventaris
Route::get('/Inventaris', 'View\InventarisController@index');
#endregion

#region Kategori
// kategori
Route::get('/Kategori', 'View\InventarisController@index');
#endregion

#region Tracking
// tracking
Route::get('/Tracking', 'View\TrackingController@index') -> name('/Tracking');
Route::get('/Tracking/List', 'View\TrackingController@listPenelitian');
Route::get('/Tracking/Detail/{idPenelitian}', 'View\TrackingController@detailPenelitian');
#endregion
