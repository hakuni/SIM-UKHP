<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\vwPenelitian;
use App\vwTrxPenelitian;
use App\Http\Controllers\ControllerApis\PenelitianController;
use App\Http\Controllers\ControllerApis\ProsedurController;
use App\Http\Controllers\ControllerApis\DownloadController as Download;

class TrackingController extends Controller
{
    public function index(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $penelitian = new PenelitianController();
        $vwListPenelitian = json_decode($penelitian->getListPenelitian(null, true)->getContent(),true);
        $banyak = count($vwListPenelitian);
        return view('tracking/index', compact('banyak'));
    }
    public function listPenelitian(Request $req){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $emailUser = $req->orderBy == 1 ? null : $_COOKIE['email'];
        $penelitian = new PenelitianController();
        $vwListPenelitian = json_decode($penelitian->getListPenelitian($emailUser, true)->getContent(),true);
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
        $vwProsedur = new ProsedurController();
        $prosedur = $vwDetailPenelitian['idProsedur'] == null ? 0 : json_decode($vwProsedur->getProsedur($vwDetailPenelitian['idProsedur'])->getContent(), true);
        $email = $_COOKIE['email'];
        $sisaBiaya = $vwDetailPenelitian["biaya"] - $vwDetailPenelitian["totalBayar"];
        $sisaBiaya = number_format($sisaBiaya,0,',','.');
        return view('tracking/detail', compact('vwDetailPenelitian', 'prosedur', 'email', 'sisaBiaya'));
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
