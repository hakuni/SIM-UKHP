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

Route::post('/login', 'UserController@loginUser');
Route::get('/clientTrack/{resi}', 'UserController@getTracking');

Route::middleware('auth:api')->group(function(){

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

    #region API Milestone
    Route::post('/milestone', 'MilestoneController@saveMilestone');
    //list kategori
    Route::get('/milestone', 'MilestoneController@getListMilestone');
    //get single kategori
    Route::get('/milestone/{id}', 'MilestoneController@getSingleMilestone');
    //update kategori
    Route::put('/milestone', 'MilestoneController@saveMilestone');
    //delete kategori
    Route::delete('/milestone/{id}', 'MilestoneController@deleteMilestone');
    #endregion

    #region API Status Penggunaan
    Route::post('/statusPenggunaan', 'StatusPenggunaanController@saveStatusPenggunaan');
    //list kategori
    Route::get('/statusPenggunaan', 'StatusPenggunaanController@getListStatusPenggunaan');
    //get single kategori
    Route::get('/statusPenggunaan/{id}', 'StatusPenggunaanController@getSingleStatusPenggunaan');
    //update kategori
    Route::put('/statusPenggunaan', 'StatusPenggunaanController@saveStatusPenggunaan');
    //delete kategori
    Route::delete('/statusPenggunaan/{id}', 'StatusPenggunaanController@deleteStatusPenggunaan');
    #endregion

    #region API Status Penelitian
    //create status
    Route::post('/status', 'StatusPenelitianController@saveStatus');
    //list status
    Route::get('/status', 'StatusPenelitianController@getListStatus');
    //get single status
    Route::get('/status/{id}', 'StatusPenelitianController@getSingleStatus');
    //update status
    Route::put('/status', 'StatusPenelitianController@saveStatus');
    //delete status
    Route::delete('/status/{id}', 'StatusPenelitianController@deleteStatus');
    #endregion

    #region API Inventarisasi

    #region master
    //create alat bahan
    Route::post('/inventarisasi', 'AlatBahanController@saveAlatBahan');
    //get list alat bahan
    Route::get('/inventarisasi', 'AlatBahanController@getListAlatBahan');
    //get single alat bahan
    Route::get('/inventarisasi/{idAlatBahan}', 'AlatBahanController@getSingleAlatBahan');
    //update alat bahan
    Route::put('/inventarisasi', 'AlatBahanController@editAlatBahan');
    //delet alat bahan
    Route::delete('/inventarisasi/{idAlatBahan}', 'AlatBahanController@deleteAlatBahan');
    #endregion

    #region logs
    //create log
    Route::post('/inventarisasiLog', 'AlatBahanController@saveLogs');
    //get list log
    Route::get('/inventarisasiLog/{tipeLog}', 'AlatBahanController@getListLog');
    #endregion

    #endregion

    #region API Penelitian

    #region master
    //create penelitian
    Route::post('/penelitian', 'PenelitianController@createPenelitian');
    //list penelitian
    Route::get('/penelitian', 'PenelitianController@getListPenelitian');
    //get single penelitian
    Route::get('/penelitian/{id}', 'PenelitianController@getSinglePenelitian');
    //update penelitian
    Route::put('/penelitian', 'PenelitianController@editPenelitian');
    //delete penelitian
    Route::delete('/penelitian/{id}', 'PenelitianController@deletePenelitian');
    #endregion

    #region API Tracking
    //continue trx
    Route::post('/penelitian/activity', 'PenelitianController@saveTrx');
    //get list trx
    Route::get('penelitian/activity/{idPenelitian}', 'PenelitianController@getListTrx');
    //cancel penelitian
    Route::put('/penelitian/activity', 'PenelitianController@batalTrx');
    //upload hasil analisis
    Route::post('/penelitian/activity/uploadAnalisis', 'PenelitianController@uploadFile');

    //log trx
    Route::get('/activity/log/{idPenelitian}', 'PenelitianController@getTrxLog');
    #endregion

    #endregion

    #region API Keuangan

    #region master
    //list keuangan
    Route::get('/keuangan', 'KeuanganController@getListKeuangan');
    #endregion

    #region rincian
    //create new list rincian
    Route::post('/keuangan/detail', 'KeuanganController@saveDetail');
    //get rincian
    Route::get('/keuangan/detail/{idPenelitian}', 'KeuanganController@getListDetail');
    //get single rincian
    Route::get('/keuangan/detail/{idPenelitian}/{idRincian}', 'KeuanganController@getSingleDetail');
    //update single rincian
    Route::put('/keuangan/detail', 'KeuanganController@editDetail');
    //delete rincian
    Route::delete('/keuangan/detail/{idRincian}', 'KeuanganController@deleteDetail');
    #endregion

    #region log
    //create log pembayaran
    Route::post('/keuanganLog', 'KeuanganController@saveLog');
    //get log pembayaran
    Route::get('/keuanganLog/{idPenelitian}', 'KeuanganController@getListLog');
    //get single log
    Route::get('/keuanganLog/{idPenelitian}/{idLog}', 'KeuanganController@getSingleLog');
    //update log
    Route::put('/keuanganLog', 'KeuanganController@editLog');
    //delete log
    Route::delete('/keuanganLog/{idLog}', 'KeuanganController@deleteLog');
    #endregion

    #endregion

    #region API Prosedur
    //create prosedur
    Route::post('/prosedur', 'ProsedurController@saveProsedur');
    //get prosedur
    Route::get('/prosedur/{idProsedur}', 'ProsedurController@getProsedur');
    //edit prosedur
    Route::put('/prosedur', 'ProsedurController@saveProsedur');
    #endregion

    #region API Dashboard
    Route::get('dashboard/pemasukan', 'DashboardController@getPemasukan');
    Route::get('dashboard/kategori', 'DashboardController@getKategori');
    Route::get('dashboard/penggunaan', 'DashboardController@getPenggunaan');
    Route::get('dashboard/banyakHewan', 'DashboardController@getBanyakPenggunaan');
    Route::get('dashboard/detailHewan', 'DashboardController@getDetailPenggunaan');
    #endregion

    #region API User
    Route::post('/user', 'UserController@createUser');
    Route::get('/user', 'UserController@getAllUser');
    Route::get('/user/{idUser}', 'UserController@getSingleUser');
    Route::put('/user', 'UserController@editUser');
    Route::delete('/user/{idUser}', 'UserController@deleteUser');

    Route::post('/logout', 'UserController@logoutUser')->middleware('auth:api');
    #endregion
});

