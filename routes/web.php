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

// penelitian
Route::get('/Penelitian', function () {
    return view('penelitian/index');
});
Route::get('/TambahPenelitian', function () {
    return view('penelitian/tambah');
});
Route::get('/UbahPenelitian/{id}', function ($id) {
    return view('penelitian/ubah', ['idPenelitian' => $id]);
});
Route::get('/Prosedur/{id}/{idPro}', function ($id, $idPro) {
    return view('prosedur/index', ['idPenelitian' => $id, 'idProsedur' => $idPro]);
});
Route::get('/TambahProsedur/{id}', function ($id) {
    return view('prosedur/tambah', ['idPenelitian' => $id]);
});
Route::get('/UbahProsedur/{id}/{idPro}', function ($id, $idPro) {
    return view('prosedur/ubah', ['idPenelitian' => $id, 'idProsedur' => $idPro]);
});

// keuangan
Route::get('/Keuangan', function () {
    return view('keuangan/index');
});
Route::get('/Rincian/{id}', function ($id) {
    return view('keuangan/rincian', ['idPenelitian' => $id]);
});
Route::get('/TambahPembayaran/{id}', function ($id) {
    return view('keuangan/tambah', ['idPenelitian' => $id]);
});

// inventaris
Route::get('/Inventaris', function () {
    return view('inventaris/index');
});

// kategori
Route::get('/Kategori', function () {
    return view('kategori/index');
});

// tracking
Route::get('/Tracking', 'View\TrackingController@index') -> name('/Tracking');
Route::get('/Tracking/List', 'View\TrackingController@listPenelitian');
Route::get('/Tracking/Detail/{idPenelitian}', 'View\TrackingController@detailPenelitian');

// Route::group(['prefix'=>'Penelitian'], function(){
//     Route::get('/', function () {
//         return view('penelitian/index');
//     });
//     Route::get('/Tambah', function () {
//         return view('penelitian/tambahPen');
//     });
// Route::get('/halamanJabatan', 'JabatanController@indexJabatan') -> name('halamanJabatan');

// });
