<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DownloadController as Download;

class InventarisController extends Controller
{
    public function index(){
        return view('inventaris/index');
    }
    public function exportInventarisasi(){
        $hasil = new Download;
        return $hasil->exportInventarisasi();
    }
}
