<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
    public function kategori(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        return view('kategori/index');
    }
    public function layanan(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        return view('layanan/index');
    }
    public function pengguna(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        return view('user/index');
    }
    public function role(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        return view('role/index');
    }
}
