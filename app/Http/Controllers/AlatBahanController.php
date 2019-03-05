<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstAlatBahan;
use App\LogPemakaian;
use App\LogPembelian;
use App\vwAlatBahan;

class AlatBahanController extends Controller
{
    #region Master
    public function getListAlatBahan(){
        try{
            $inventarisasi = vwAlatBahan::All();
            $inventarisasi->ErrorType = 0;
            return response($inventarisasi)->setStatusCode(200);
        }
        catch(\Exception $e){
            $inventarisasi = new vwKeuangan;
            $inventarisasi->ErrorType = 2;
            $inventarisasi->ErrorMessage = $e->getMessage();
            return response($inventarisasi)->setStatusCode(204);
        }
    }

    public function getListHewan($tipe){
        try{
            $inventarisasi = new MstAlatBahan;
            $inventarisasi = MstAlatBahan::where('tipeAlatBahan', $tipe)->get();
            $inventarisasi->ErrorType = 0;
            return response($inventarisasi)->setStatusCode(200);
        }
        catch(\Exception $e){
            $inventarisasi = new MstAlatBahan;
            $inventarisasi->ErrorType = 2;
            $inventarisasi->ErrorMessage = $e->getMessage();
            return response($inventarisasi)->setStatusCode(204);
        }
    }

    public function deleteAlatBahan($id){
        try{
            $inventarisasi = MstAlatBahan::findOrFail($id);
            $inventarisasi->delete();
            $inventarisasi->ErrorType = 0;
            return response($inventarisasi)->setStatusCode(200);

        }
        catch(\Exception $e){
            $inventarisasi = new vwKeuangan;
            $inventarisasi->ErrorType = 2;
            $inventarisasi->ErrorMessage = $e->getMessage();
            return response($inventarisasi)->setStatusCode(422);
        }
    }
    #endregion

    #region Log
    public function saveLogs(Request $request){
        try{
            //save alat bahan dulu
            $cek = MstAlatBahan::where('namaAlatBahan', strtoupper($request->namaAlatBahan))->orWhere('idAlatBahan', $request->namaAlatBahan)->first();
            if($cek == null){
                $cek = new MstAlatBahan;
                $cek->namaAlatBahan = strtoupper($request->namaAlatBahan);
                $cek->tipeAlatBahan = $request->tipeAlatBahan;
                $cek->createdBy = 'kuni';
                $cek->save();
            }

            if($request->tipeTrx == 1){
                $logTrx = $request->isMethod('post') ? new LogPembelian : LogPembelian::findOrFail($request->idLog);
                $logTrx->harga = $request->harga;
            }
            else if($request->tipeTrx == 2){
                $logTrx = $request->isMethod('post') ? new LogPemakaian : LogPemakaian::findOrFail($request->idLog);
            }
            $logTrx->namaAlatBahan = $cek->namaAlatBahan;
            $logTrx->tglTrx = date("y-m-d", strtotime($request->tglTrx));
            $logTrx->jumlah = $request->jumlah;

            $logTrx->createdBy = 'kuni';

            $logTrx->save();
            $logTrx->ErrorType = 0;
            return response($logTrx)->setStatusCode(200);
        }
        catch(\Exception $e){
            $logTrx = new LogPembelian;
            $logTrx->ErrorType = 2;
            $logTrx->ErrorMessage = $e->getMessage();
            return response($logTrx)->setStatusCode(422);
        }
    }

    public function getListLog(Request $req, $tipeLog){
        try{
            if($tipeLog == 1){
                if($req->bulan == null){
                    if($req->tahun == null){
                        $log = LogPembelian::All();
                    }
                    else {
                        $log = LogPembelian::whereYear('tglTrx', $req->tahun)->get();
                    }
                }
                else{
                    if($req->tahun == null){
                        $log = LogPembelian::whereMonth('tglTrx', $req->bulan)->get();
                    }
                    else {
                        $log = LogPembelian::whereYear('tglTrx', $req->tahun)->whereMonth('tglTrx', $req->bulan)->get();
                    }
                }
            }
            else{
                if($req->bulan == null){
                    if($req->tahun == null){
                        $log = LogPemakaian::All();
                    }
                    else {
                        $log = LogPemakaian::whereYear('tglTrx', $req->tahun)->get();
                    }
                }
                else{
                    if($req->tahun == null){
                        $log = LogPemakaian::whereMonth('tglTrx', $req->bulan)->get();
                    }
                    else {
                        $log = LogPemakaian::whereYear('tglTrx', $req->tahun)->whereMonth('tglTrx', $req->bulan)->get();
                    }
                }
            }
            $log->ErrorType = 0;
            return response($log)->setStatusCode(200);
        }
        catch(\Exception $e){
            $log = new LogPembelian;
            $log->ErrorType = 2;
            $log->ErrorMessage = $e->getMessage();
            return response($log)->setStatusCode(442);
        }
    }
    #endregion
}
