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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', 'ControllerApis\UserController@loginUser');
Route::get('/clientTrack/{resi}', 'ControllerApis\UserController@getTracking');


Route::middleware('auth:api')->group(function(){
    
    Route::get('/exportRincian/{idPenelitian}', 'ControllerApis\DownloadController@exportRincian');
    Route::get('/exportProsedur/{idPenelitian}', 'ControllerApis\DownloadController@exportProsedur');
    Route::get('/exportInventarisasi', 'ControllerApis\DownloadController@exportProsedur');
    Route::get('/downloadData/{idPenelitian}', 'ControllerApis\DownloadController@downloadData');
    Route::get('/downloadAnalisis/{idPenelitian}', 'ControllerApis\DownloadController@downloadAnalisis');
    
    #region API Kategori
    //create kategori
    Route::post('/kategori', 'ControllerApis\KategoriController@saveKategori');
    //list kategori
    Route::get('/kategori', 'ControllerApis\KategoriController@getListKategori');
    //get single kategori
    Route::get('/kategori/{id}', 'ControllerApis\KategoriController@getSingleKategori');
    //update kategori
    Route::put('/kategori', 'ControllerApis\KategoriController@saveKategori');
    //delete kategori
    Route::delete('/kategori/{id}', 'ControllerApis\KategoriController@deleteKategori');
    #endregion

    #region API Milestone
    Route::post('/milestone', 'ControllerApis\MilestoneController@saveMilestone');
    //list kategori
    Route::get('/milestone', 'ControllerApis\MilestoneController@getListMilestone');
    //get single kategori
    Route::get('/milestone/{id}', 'ControllerApis\MilestoneController@getSingleMilestone');
    //update kategori
    Route::put('/milestone', 'ControllerApis\MilestoneController@saveMilestone');
    //delete kategori
    Route::delete('/milestone/{id}', 'ControllerApis\MilestoneController@deleteMilestone');
    #endregion

    #region API Status Penggunaan
    Route::post('/statusPenggunaan', 'ControllerApis\StatusPenggunaanController@saveStatusPenggunaan');
    //list kategori
    Route::get('/statusPenggunaan', 'ControllerApis\StatusPenggunaanController@getListStatusPenggunaan');
    //get single kategori
    Route::get('/statusPenggunaan/{id}', 'ControllerApis\StatusPenggunaanController@getSingleStatusPenggunaan');
    //update kategori
    Route::put('/statusPenggunaan', 'ControllerApis\StatusPenggunaanController@saveStatusPenggunaan');
    //delete kategori
    Route::delete('/statusPenggunaan/{id}', 'ControllerApis\StatusPenggunaanController@deleteStatusPenggunaan');
    #endregion

    #region API Status Penelitian
    //create status
    Route::post('/status', 'ControllerApis\StatusPenelitianController@saveStatus');
    //list status
    Route::get('/status', 'ControllerApis\StatusPenelitianController@getListStatus');
    //get single status
    Route::get('/status/{id}', 'ControllerApis\StatusPenelitianController@getSingleStatus');
    //update status
    Route::put('/status', 'ControllerApis\StatusPenelitianController@saveStatus');
    //delete status
    Route::delete('/status/{id}', 'ControllerApis\StatusPenelitianController@deleteStatus');
    #endregion

    #region API Inventarisasi

    #region master
    //create alat bahan
    Route::post('/inventarisasi', 'ControllerApis\AlatBahanController@saveAlatBahan');
    //get list alat bahan
    Route::get('/inventarisasi', 'ControllerApis\AlatBahanController@getListAlatBahan');
    //get single alat bahan
    Route::get('/inventarisasi/{idAlatBahan}', 'ControllerApis\AlatBahanController@getSingleAlatBahan');
    //update alat bahan
    Route::put('/inventarisasi', 'ControllerApis\AlatBahanController@editAlatBahan');
    //delet alat bahan
    Route::delete('/inventarisasi/{idAlatBahan}', 'ControllerApis\AlatBahanController@deleteAlatBahan');
    #endregion

    #region logs
    //create log
    Route::post('/inventarisasiLog', 'ControllerApis\AlatBahanController@saveLogs');
    //get list log
    Route::get('/inventarisasiLog/{tipeLog}', 'ControllerApis\AlatBahanController@getListLog');
    #endregion

    #endregion

    #region API Penelitian

    #region master
    //create penelitian
    Route::post('/penelitian', 'ControllerApis\PenelitianController@createPenelitian');
    //list penelitian
    Route::get('/penelitian', 'ControllerApis\PenelitianController@getListPenelitian');
    //get single penelitian
    Route::get('/penelitian/{id}', 'ControllerApis\PenelitianController@getSinglePenelitian');
    //update penelitian
    Route::put('/penelitian', 'ControllerApis\PenelitianController@editPenelitian');
    //delete penelitian
    Route::delete('/penelitian/{id}', 'ControllerApis\PenelitianController@deletePenelitian');
    #endregion

    #region API Tracking
    //continue trx
    Route::post('/penelitian/activity', 'ControllerApis\PenelitianController@saveTrx');
    //get list trx
    Route::get('penelitian/activity/{idPenelitian}', 'ControllerApis\PenelitianController@getListTrx');
    //cancel penelitian
    Route::put('/penelitian/activity', 'ControllerApis\PenelitianController@batalTrx');
    //upload hasil analisis
    Route::post('/penelitian/activity/uploadAnalisis', 'ControllerApis\PenelitianController@uploadFile');

    //log trx
    Route::get('/activity/log/{idPenelitian}', 'ControllerApis\PenelitianController@getTrxLog');
    #endregion

    #endregion

    #region API Keuangan

    #region master
    //list keuangan
    Route::get('/keuangan', 'ControllerApis\KeuanganController@getListKeuangan');
    #endregion

    #region rincian
    //create new list rincian
    Route::post('/keuangan/detail', 'ControllerApis\KeuanganController@saveDetail');
    //get rincian
    Route::get('/keuangan/detail/{idPenelitian}', 'ControllerApis\KeuanganController@getListDetail');
    //get single rincian
    Route::get('/keuangan/detail/{idPenelitian}/{idRincian}', 'ControllerApis\KeuanganController@getSingleDetail');
    //update single rincian
    Route::put('/keuangan/detail', 'ControllerApis\KeuanganController@editDetail');
    //delete rincian
    Route::delete('/keuangan/detail/{idRincian}', 'ControllerApis\KeuanganController@deleteDetail');
    #endregion

    #region log
    //create log pembayaran
    Route::post('/keuanganLog', 'ControllerApis\KeuanganController@saveLog');
    //get log pembayaran
    Route::get('/keuanganLog/{idPenelitian}', 'ControllerApis\KeuanganController@getListLog');
    //get single log
    Route::get('/keuanganLog/{idPenelitian}/{idLog}', 'ControllerApis\KeuanganController@getSingleLog');
    //update log
    Route::put('/keuanganLog', 'ControllerApis\KeuanganController@editLog');
    //delete log
    Route::delete('/keuanganLog/{idLog}', 'ControllerApis\KeuanganController@deleteLog');
    #endregion

    #endregion

    #region API Prosedur
    //create prosedur
    Route::post('/prosedur', 'ControllerApis\ProsedurController@saveProsedur');
    //get prosedur
    Route::get('/prosedur/{idProsedur}', 'ControllerApis\ProsedurController@getProsedur');
    //edit prosedur
    Route::put('/prosedur', 'ControllerApis\ProsedurController@saveProsedur');
    #endregion

    #region API Dashboard
    Route::get('dashboard/pemasukan', 'ControllerApis\DashboardController@getPemasukan');
    Route::get('dashboard/kategori', 'ControllerApis\DashboardController@getKategori');
    Route::get('dashboard/penggunaan', 'ControllerApis\DashboardController@getPenggunaan');
    Route::get('dashboard/banyakHewan', 'ControllerApis\DashboardController@getBanyakPenggunaan');
    Route::get('dashboard/detailHewan', 'ControllerApis\DashboardController@getDetailPenggunaan');
    #endregion

    #region API User
    Route::post('/user', 'ControllerApis\UserController@createUser');
    Route::get('/user', 'ControllerApis\UserController@getAllUser');
    Route::get('/user/{idUser}', 'ControllerApis\UserController@getSingleUser');
    Route::put('/user', 'ControllerApis\UserController@editUser');
    Route::delete('/user/{idUser}', 'ControllerApis\UserController@deleteUser');

    Route::get('/user/notifikasi/{statusTelat}', 'ControllerApis\UserController@getNotificationLog');

    Route::post('/logout', 'ControllerApis\UserController@logoutUser');
    Route::get('/cekToken', 'ControllerApis\UserController@cekToken');
    #endregion

    #region API Role
    Route::post('/role', 'ControllerApis\RoleController@saveRole');
    Route::get('/role', 'ControllerApis\RoleController@getListRole');
    Route::get('/role/{idRole}', 'ControllerApis\RoleController@getSingleRole');
    Route::put('/role', 'ControllerApis\RoleController@saveRole');
    Route::delete('/role/{idRole}', 'ControllerApis\RoleController@deleteRole');

    #endregion
});

