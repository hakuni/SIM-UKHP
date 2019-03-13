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
    public function saveAlatBahan(Request $request){
        try{
            $alatBahan = new MstAlatBahan;
            $alatBahan->namaAlatBahan = $request->namaAlatBahan;
            $alatBahan->tipeAlatBahan = $request->tipeAlatBahan;
            $alatBahan->harga = $request->harga;
            $alatBahan->satuan = $request->satuan;
            $alatBahan->createdBy = 'kuni';

            $alatBahan->save();

            $alatBahan->ErrorType = 0;
            return response($alatBahan);
        }
        catch(\Exception $e){
            $alatBahan = new MstAlatBahan;
            $alatBahan->ErrorType = 2;
            $alatBahan->ErrorMessage = $e->getMessage();
            return response($alatBahan);
        }
    }

    public function getListAlatBahan(Request $req){
        try{
            if($req->tipe == null) //get data view
                $inventarisasi = vwAlatBahan::All();
            else if($req->tipe == 0) //get semua list
                $inventarisasi = MstAlatBahan::All();
            else if($req->tipe == -1) //get kecuali jasa
                $inventarisasi = MstAlatBahan::where('tipeAlatBahan', '!=', 3)->get();
            else //get sesuai tipe
                $inventarisasi = MstAlatBahan::where('tipeAlatBahan', $req->tipe)->get();
            $inventarisasi->ErrorType = 0;
            return response($inventarisasi)->setStatusCode(200);
        }
        catch(\Exception $e){
            $inventarisasi = new vwAlatBahan;
            $inventarisasi->ErrorType = 2;
            $inventarisasi->ErrorMessage = $e->getMessage();
            return response($inventarisasi)->setStatusCode(204);
        }
    }

    public function getSingleAlatBahan($idAlatBahan){
        try{
            $inventarisasi = new MstAlatBahan;
            $inventarisasi = MstAlatBahan::where('idAlatBahan', $idAlatBahan)->first();
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

    public function editAlatBahan(Request $request){
        try{
            $alatBahan = new MstAlatBahan;
            $alatBahan = MstAlatBahan::findOrFail($request->idAlatBahan);
            $alatBahan->namaAlatBahan = $request->namaAlatBahan;
            $alatBahan->tipeAlatBahan = $request->tipeAlatBahan;
            $alatBahan->harga = $request->harga;
            $alatBahan->satuan = $request->satuan;
            $alatBahan->updatedBy = 'kuni';

            $alatBahan->save();

            $alatBahan->ErrorType = 0;
            return response($alatBahan);
        }
        catch(\Exception $e){
            $alatBahan = new MstAlatBahan;
            $alatBahan->ErrorType = 2;
            $alatBahan->ErrorMessage = $e->getMessage();
            return response($alatBahan);
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
            $inventarisasi = new MstAlatBahan;
            $inventarisasi->ErrorType = 2;
            $inventarisasi->ErrorMessage = $e->getMessage();
            return response($inventarisasi)->setStatusCode(422);
        }
    }
    #endregion

    #region Log
    public function saveLogs(Request $request){
        try{
            $logRepo = $request->tipeTrx == 1 ? new LogPembelian : new LogPemakaian;

            $logTrx = $request->isMethod('post') ? new $logRepo : $logRepo::findOrFail($request->idLog);

            if($request->tipeTrx == 1){
                $logTrx->harga = $request->harga;
            }

            $logTrx->namaAlatBahan = MstAlatBahan::findOrFail($request->namaAlatBahan)->namaAlatBahan;
            $logTrx->tglTrx = date("y-m-d", strtotime($request->tglTrx));
            $logTrx->jumlah = $request->jumlah;

            $logTrx->createdBy = 'kuni';

            $logTrx->save();
            $logTrx->ErrorType = 0;
            return response($logTrx)->setStatusCode(200);
        }
        catch(\Exception $e){
            $logTrx = $request->tipeTrx == 1 ? new LogPembelian : new LogPemakaian;
            $logTrx->ErrorType = 2;
            $logTrx->ErrorMessage = $e->getMessage();
            return response($logTrx)->setStatusCode(422);
        }
    }

    public function getListLog(Request $req, $tipeLog){
        try{
            $logRepo = $tipeLog == 1 ? new LogPembelian : new LogPemakaian;
            if($req->bulan == null){
                if($req->tahun == null){
                    $log = $logRepo::All();
                }
                else {
                    $log = $logRepo::whereYear('tglTrx', $req->tahun)->get();
                }
            }
            else{
                if($req->tahun == null){
                    $log = $logRepo::whereMonth('tglTrx', $req->bulan)->get();
                }
                else {
                    $log = $logRepo::whereYear('tglTrx', $req->tahun)->whereMonth('tglTrx', $req->bulan)->get();
                }
            }
            $log->ErrorType = 0;
            return response($log)->setStatusCode(200);
        }
        catch(\Exception $e){
            $log = $tipeLog == 1 ? new LogPembelian : new LogPemakaian;
            $log->ErrorType = 2;
            $log->ErrorMessage = $e->getMessage();
            return response($log)->setStatusCode(442);
        }
    }
    #endregion
}
