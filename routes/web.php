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
    return view('penelitian/tambahPen');
});
Route::get('/TambahProsedur/{id}', function ($id) {
    return view('penelitian/tambahPro', ['idPenelitian' => $id]);
});
Route::get('/UbahPenelitian/{id}', function ($id) {
    return view('penelitian/ubahPen', ['idPenelitian' => $id]);
});
// keuangan
Route::get('/Keuangan', function () {
    return view('keuangan/index');
});
Route::get('/Rincian/{id}', function ($id) {
    return view('keuangan/rincian', ['idPenelitian' => $id]);
});
Route::get('/TambahPembayaran', function () {
    return view('keuangan/tambah');
});
// inventaris
Route::get('/Inventaris', function () {
    return view('inventaris/index');
});
// kategori
Route::get('/Kategori', function () {
    return view('kategori/index');
});

// Route::group(['prefix'=>'Penelitian'], function(){
//     Route::get('/', function () {
//         return view('penelitian/index');
//     });
//     Route::get('/Tambah', function () {
//         return view('penelitian/tambahPen');
//     });

// });
