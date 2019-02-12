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
            return response()->json(['data'=>$inventarisasi])->setStatusCode(200);
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
            return response()->json(['data'=>$inventarisasi])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getSingleAlatBahan($id){
        try{
            $inventarisasi = vwAlatBahan::findOrFail($id);
            return response()->json(['data'=>$inventarisasi])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getCode()])->setStatusCode(204);
        }
    }
    
    public function deleteAlatBahan($id){
        try{
            $inventarisasi = MstAlatBahan::findOrFail($id);

            $inventarisasi->delete();
            return response()->json(['data'=>$inventarisasi])->setStatusCode(200);

        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }
    #endregion

    #region Log
    public function saveLogs(Request $request){
        try{
            if($request->tipeTrx == 1){
                $logTrx = $request->isMethod('post') ? new LogPembelian : LogPembelian::findOrFail($request->idLog);
                $logTrx->harga = $request->harga;
            }
            else if($request->tipeTrx == 2){
                $logTrx = $request->isMethod('post') ? new LogPemakaian : LogPemakaian::findOrFail($request->idLog);
            }
            $logTrx->idAlatBahan = $request->idAlatBahan;
            $logTrx->tglTrx = $request->tglTrx;
            $logTrx->jumlah = $request->jumlah;

            $logTrx->createdBy = 'kuni';

            $logTrx->save();
            return response()->json(['data'=>$logTrx])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getListLog($idAlatBahan){
        try{
            $logPembelian = LogPembelian::where('idAlatBahan', $idAlatBahan)->get();
            $logPemakaian = LogPemakaian::where('idAlatBahan', $idAlatBahan)->get();
            return response()->json(['data'=> ['logPembelian'=>$logPembelian, 'logPemakaian'=>$logPemakaian]])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }
    #endregion
}
