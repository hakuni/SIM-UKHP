<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenelitianController;
use App\vwPenelitian;

class TrackingController extends Controller
{
    public function index(){
        return view("tracking/index");
    }
    public function listPenelitian()
    {
        $vwListPenelitian = vwPenelitian::All();
        $idPenelitian = $vwListPenelitian[0]->idPenelitian;
        return view('tracking/list', compact('vwListPenelitian', 'idPenelitian'));
    }
    public function detailPenelitian($idPenelitian){
        $vwDetailPenelitian = vwPenelitian::where('idPenelitian', $idPenelitian)->first();
        return view('tracking/detail')->with('vwDetailPenelitian', $vwDetailPenelitian);
    }
}
