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
        return view("tracking/index");
    }
    public function listPenelitian()
    {
        $vwListPenelitian = vwPenelitian::orderBy('idStatusPenelitian', 'desc')->get();
        $idPenelitian = $vwListPenelitian[0]->idPenelitian;
        $banyak = count($vwListPenelitian);
        return view('tracking/list', compact('vwListPenelitian', 'idPenelitian', 'banyak'));
    }
    public function detailPenelitian($idPenelitian){
        $vwDetailPenelitian = vwTrxPenelitian::where('idPenelitian', $idPenelitian)->orderBy('idTrxPenelitian', 'desc')->first();
        return view('tracking/detail')->with('vwDetailPenelitian', $vwDetailPenelitian);
    }
}
