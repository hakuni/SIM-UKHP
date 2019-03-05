<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenelitianController as Penelitian;

class PenelitianController extends Controller
{
    //
    public function index(){
        return view('penelitian/index');
    }
    public function tambahPenelitian(){
        return view('penelitian/tambah');
    }
    public function ubahPenelitian($id){
        $vwPenelitian = new Penelitian();
        $penelitian = json_decode($vwPenelitian->getSinglePenelitian($id)->getContent(), true);
        return view('penelitian/ubah', compact('penelitian'));
    }
}
