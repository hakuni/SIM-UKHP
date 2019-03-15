<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
    public function kategori(){
        return view('kategori/index');
    }
    public function layanan(){
        return view('layanan/index');
    }
    public function pengguna(){
        return view('user/index');
    }
}
