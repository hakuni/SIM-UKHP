<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenelitianController;
use App\vwPenelitian;
use App\vwTrxPenelitian;
use App\Http\Controllers\DownloadController as Download;

class TrackingController extends Controller
{
    public function index(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $penelitian = new PenelitianController();
        $vwListPenelitian = json_decode($penelitian->getListPenelitian()->getContent(),true);
        $banyak = count($vwListPenelitian);
        return view('tracking/index', compact('banyak'));
    }
    public function listPenelitian(Request $req){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $emailUser = $req->orderBy == 1 ? null : $_COOKIE['email'];
        $penelitian = new PenelitianController();
        $vwListPenelitian = json_decode($penelitian->getListPenelitian($emailUser)->getContent(),true);
        $idPenelitian = 0;
        if(count($vwListPenelitian) > 0)
            $idPenelitian = $vwListPenelitian[0]['idPenelitian'];
        $banyak = count($vwListPenelitian);
        return view('tracking/list', compact('vwListPenelitian', 'idPenelitian', 'banyak'));
    }
    public function detailPenelitian($idPenelitian){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $penelitian = new PenelitianController();
        $vwDetailPenelitian = json_decode($penelitian->getDetailTrx($idPenelitian)->getContent(), true);
        return view('tracking/detail', compact('vwDetailPenelitian'));
    }

    public function exportData($idPenelitian){
        $hasil = new Download;
        return $hasil->downloadData($idPenelitian);
    }

     public function exportAnalisis($idPenelitian){
        $hasil = new Download;
        return $hasil->downloadAnalisis($idPenelitian);
    }
}
