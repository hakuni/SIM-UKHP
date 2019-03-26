<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenelitianController as Penelitian;

class PenelitianController extends Controller
{
    //
    public function index(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        return view('penelitian/index');
    }
    public function tambahPenelitian(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        return view('penelitian/tambah');
    }
    public function ubahPenelitian($id){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $vwPenelitian = new Penelitian();
        $penelitian = json_decode($vwPenelitian->getSinglePenelitian($id)->getContent(), true);
        return view('penelitian/ubah', compact('penelitian'));
    }
}
