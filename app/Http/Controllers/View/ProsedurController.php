<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProsedurController as Prosedur;
use App\Http\Controllers\PenelitianController as Penelitian;
use App\Http\Controllers\DownloadController as Download;

class ProsedurController extends Controller
{
    //
    public function index($idPen, $idPro){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $vwProsedur = new Prosedur();
        $prosedur = json_decode($vwProsedur->getProsedur($idPro)->getContent(), true);
        $idPen = $prosedur['idPenelitian'];
        return view('prosedur/index', compact('prosedur', 'idPen'));
    }
    public function tambahProsedur($idPen){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $vwPenelitian = new Penelitian();
        $penelitian = json_decode($vwPenelitian->getSinglePenelitian($idPen)->getContent(), true);
        $idKategori = $penelitian['idKategori'];
        $kategori = $penelitian['namaKategori'];
        return view('prosedur/tambah', compact('idKategori', 'kategori', 'idPen'));
    }
    public function ubahProsedur($idPen, $idPro){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $vwProsedur = new Prosedur();
        $prosedur = json_decode($vwProsedur->getProsedur($idPro)->getContent(), true);
        return view('prosedur/ubah', compact('prosedur', 'idPen'));
    }

    public function exportProsedur($idPenelitian){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $hasil = new Download;
        return $hasil->exportProsedur($idPenelitian);
    }
}
