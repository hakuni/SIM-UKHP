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

// login
Route::get('/Login', function () {
    return view('login/index');
});
// dashboard
Route::get('/Dashboard', function () {
    return view('dashboard/index');
});

#region Tracking
// tracking
Route::get('/Tracking', 'View\TrackingController@index') -> name('/Tracking');
Route::get('/Tracking/List', 'View\TrackingController@listPenelitian');
Route::get('/Tracking/Detail/{idPenelitian}', 'View\TrackingController@detailPenelitian');
Route::get('/DataPenelitian/{idPenelitian}', 'View\TrackingController@exportData');
Route::get('/AnalisisPenelitian/{idPenelitian}', 'View\TrackingController@exportAnalisis');
#endregionilPenelitian');
#endregion

#region Penelitian
// penelitian
Route::group(['prefix'=>'Penelitian'], function(){
    Route::get('/', 'View\PenelitianController@index');
    Route::get('/TambahPenelitian', 'View\PenelitianController@tambahPenelitian');
    Route::get('/UbahPenelitian/{id}', 'View\PenelitianController@ubahPenelitian');
    //prosedur
    Route::get('/Prosedur/{idPen}/{idPro}', 'View\ProsedurController@index');
    Route::get('/TambahProsedur/{idPen}', 'View\ProsedurController@tambahProsedur');
    Route::get('/UbahProsedur/{idPen}/{idPro}', 'View\ProsedurController@ubahProsedur');
    Route::get('/Download/{idPenelitian}', 'View\ProsedurController@exportProsedur');
});
#endregion

#region Keuangan
// keuangan
Route::group(['prefix'=>'Keuangan'], function(){
    Route::get('/', 'View\KeuanganController@index');
    Route::get('/Rincian/{id}', 'View\KeuanganController@rincian');
});
#endregion

#region Inventaris
// inventaris
Route::get('/Inventaris', 'View\InventarisController@index');
#endregion

#region Master
// kategori
Route::get('/Kategori', 'View\MasterController@kategori');
// layanan
Route::get('/Layanan', 'View\MasterController@layanan');
// layanan
Route::get('/Pengguna', 'View\MasterController@pengguna');
#endregion

//client
Route::get('/', 'View\ClientController@index');

