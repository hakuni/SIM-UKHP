<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerApis\DownloadController as Download;

class InventarisController extends Controller
{
    public function index(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        return view('inventaris/index');
    }
    public function exportInventarisasi(){
        if(!isset($_COOKIE['access_token'])){
            return redirect('/Login');
        }
        $hasil = new Download;
        return $hasil->exportInventarisasi();
    }
}
