<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenelitianController;
use App\vwPenelitian;
use App\vwTrxPenelitian;

class TrackingController extends Controller
{
    public function index(){
        $penelitian = new PenelitianController();
        $vwListPenelitian = json_decode($penelitian->getListPenelitian()->getContent(),true);
        $banyak = count($vwListPenelitian);
        return view('tracking/index', compact('banyak'));
    }
    public function listPenelitian(Request $req){
        $orderBy = $req->orderBy == null ? 1 : $req->orderBy;
        $penelitian = new PenelitianController();
        $vwListPenelitian = json_decode($penelitian->getListPenelitian($orderBy)->getContent(),true);
        $idPenelitian = 0;
        if(count($vwListPenelitian) > 0)
            $idPenelitian = $vwListPenelitian[0]['idPenelitian'];
        $banyak = count($vwListPenelitian);
        return view('tracking/list', compact('vwListPenelitian', 'idPenelitian', 'banyak'));
    }
    public function detailPenelitian($idPenelitian){
        $penelitian = new PenelitianController();
        $vwDetailPenelitian = json_decode($penelitian->getDetailTrx($idPenelitian)->getContent(), true);
        return view('tracking/detail')->with('vwDetailPenelitian', $vwDetailPenelitian);
    }
}
