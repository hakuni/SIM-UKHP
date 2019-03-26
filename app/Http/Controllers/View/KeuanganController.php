<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenelitianController as Penelitian;

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
}
