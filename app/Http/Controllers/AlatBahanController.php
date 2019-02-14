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
            $inventarisasi = MstAlatBahan::All();
            return response($inventarisasi)->setStatusCode(200);
        }
        catch(\Exception $ex){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }

    public function saveAlatBahan(Request $request){
        try{
            $inventarisasi = $request->isMethod('put') ? MstAlatBahan::findOrFail($request->idAlatBahan) : new MstAlatBahan;
            $inventarisasi->fill($request->all());

            if($request->isMethod('put'))
                $inventarisasi->updatedBy = 'kuni';
            else
                $inventarisasi->createdBy = 'kuni';

            $inventarisasi->save();
            return response($inventarisasi)->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getSingleAlatBahan($id){
        try{
            $inventarisasi = vwAlatBahan::findOrFail($id);
            return response($inventarisasi)->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getCode()])->setStatusCode(204);
        }
    }

    public function deleteAlatBahan($id){
        try{
            $inventarisasi = MstAlatBahan::findOrFail($id);

            $inventarisasi->delete();
            return response($inventarisasi)->setStatusCode(200);

        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
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
            return response($penelitian)->setStatusCode(422);
        }
    }

    public function getListLog($tipeLog){
        try{
            if($tipeLog == 1){
                $log = LogPembelian::All();
            }
            else{
                $log = LogPemakaian::All();
            }
            $log->ErrorType = 0;
            return response()->json(['data'=> $log])->setStatusCode(200);
        }
        catch(\Exception $e){
            $log = new LogPembelian;
            $log->ErrorType = 2;
            $log->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(442);
        }
    }
    #endregion
}
