<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenelitianController as Penelitian;

class KeuanganController extends Controller
{
    public function index(){
        return view('keuangan/index');
    }
    public function rincian($id){
        $vwPenelitian = new Penelitian;
        $statusPenelitian = json_decode($vwPenelitian->getSinglePenelitian($id)->getContent(), true)['idStatusPenelitian'];
        return view('keuangan/rincian', compact('id', 'statusPenelitian'));
    }
}
