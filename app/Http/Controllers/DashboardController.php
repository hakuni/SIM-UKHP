<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getPemasukan(Request $req){ //butuh bulan/tahun utk filter
        try{
            $pemasukan = DB::table('vw_pemasukans')->where('tahun', date('Y'))->get();
            return response($pemasukan);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }

    public function getKategori(Request $req){ //butuh bulan/tahun utk filter
        try{
            $kategori = DB::table('vw_kategorips')->where('tahun', date('Y'))->get();
            return response($kategori);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }

    public function getPenggunaan(Request $req){ //butuh bulan/tahun utk filter
        try{
            $penggunaan = DB::table('vw_penggunaanps')->where('tahun', date('Y'))->get();
            return response($penggunaan);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }

    public function getBanyakPenggunaan(Request $req){
        try{
            $banyak = DB::table('vw_banyaks')->where('tahun', date('Y'))->get();
            return response($banyak);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }
}
