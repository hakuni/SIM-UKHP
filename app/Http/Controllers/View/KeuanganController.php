<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerApis\PenelitianController as Penelitian;
use App\Http\Controllers\ControllerApis\DownloadController as Download;

class KeuanganController extends Controller
{
    public function index(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        return view('keuangan/index');
    }
    public function rincian($id){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $vwPenelitian = new Penelitian;
        $statusPenelitian = json_decode($vwPenelitian->getSinglePenelitian($id)->getContent(), true)['idStatusPenelitian'];
        return view('keuangan/rincian', compact('id', 'statusPenelitian'));
    }

    public function exportRincian($id){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $hasil = new Download;
        $file = $hasil->exportRincian($id);
        $cek = json_decode($file->getContent(), true);
        if($cek){
            echo("<script> 
                alert('Prosedur belum dibuat');
                location.href = '/Keuangan/Rincian/".$id."'
                </script>");
        }
        else 
            return $file;
    }
}
