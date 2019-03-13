<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getPemasukan(Request $req){ //butuh tahun utk filter
        try{
            $tahun = $req->tahun == null ? date('Y') : $req->tahun;
            $pemasukan = DB::table('vw_pemasukans')->where('tahun', $tahun)->get();
            return response($pemasukan);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }

    public function getKategori(Request $req){ //butuh tahun utk filter
        try{
            $tahun = $req->tahun == null ? date('Y') : $req->tahun;
            $kategori = DB::table('vw_kategorips')->where('tahun', $tahun)->get();
            return response($kategori);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }

    public function getPenggunaan(Request $req){ //butuh tahun utk filter
        try{
            $tahun = $req->tahun == null ? date('Y') : $req->tahun;
            $penggunaan = DB::table('vw_penggunaanps')->where('tahun', $tahun)->get();
            return response($penggunaan);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }

    public function getDetailPenggunaan(Request $req){
        try{
            $tahun = $req->tahun == null ? date('Y') : $req->tahun;
            $bulanAkhir = $req->periode+5;
            $banyak = DB::table('vw_banyaks')
                        ->where('tahun', $tahun)
                        ->where('bulan', '>=', $req->periode)
                        ->where('bulan', '<=', $bulanAkhir)
                        ->where('idAlatBahan', $req->idAlatBahan)
                        ->get();

            return response($banyak);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }

    public function getBanyakPenggunaan(Request $req){
        try{
            $tahun = ($req->tahun == null ? date('Y') : $req->tahun);
            $bulanAkhir = $req->bulan+5;

            $banyak = DB::select('select
                                mab.namaAlatBahan as namaAlatBahan,
                                SUM(rb.jumlah) as banyak,
                                YEAR(rb.created_at) as tahun
                                from
                                rincian_biayas rb JOIN mst_alat_bahans mab ON mab.idAlatBahan = rb.idAlatBahan
                                JOIN mst_penelitians mp ON mp.idPenelitian = rb.idPenelitian
                                where
                                mp.statusPenelitian != 4 AND mab.tipeAlatBahan = 1
                                AND MONTH(rb.created_at) >= :bulan 
                                AND MONTH(rb.created_at) <= :bulanAkhir
                                AND YEAR(rb.created_at) = :tahun
                                group by mab.namaAlatBahan, YEAR(rb.created_at)', ['bulan' => $req->periode, 'bulanAkhir' => $bulanAkhir, 'tahun'=>$tahun]);
                
            return response($banyak);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }
}