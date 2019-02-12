<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstKeuangan;
use App\RincianBiaya;
use App\LogPembayaran;
use App\vwKeuangan;
use App\vwRincian;

class KeuanganController extends Controller
{
    #region Master
    public function getListKeuangan(){
        try{
            $keuangan = vwKeuangan::All();
            return response()->json(['data'=>$keuangan])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }
    #endregion

    #region Rincian
    public function saveDetail(Request $request){
        try{
            $rincian = $request->isMethod('put') ? RincianBiaya::findOrFail($request->idRincianBiaya) : new RincianBiaya;

            $rincian->fill($request->all());
            if($request->isMethod('post'))
                $rincian->createdBy = 'kuni';
            else
                $rincian->updatedBy = 'kuni';
            $rincian->save();
            return response()->json(['data'=>$rincian])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getListDetail($idPenelitian){
        try{
            $rincian = vwRincian::where('idPenelitian', $idPenelitian)->get();
            return response()->json(['data'=>$rincian])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getSingleDetail($idPenelitian, $idRincian){
        try{
            $rincian = vwRincian::findOrFail($idRincian);
            return response()->json(['data'=>$rincian])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function deleteDetail($idRincian){
        try{
            $rincian = vwRincian::findOrFail($idRincian);
            $rincian->delete();
            return response()->json(['data'=>$rincian])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }
    #endregion

    #region Log Pembayaran
    public function saveLog(Request $request){
        try{
            $logPembayaran = $request->isMethod('put') ? LogPembayaran::findOrFail($request->idPenelitian) : new LogPembayaran;

            $logPembayaran->fill($request->all());
            $logPembayaran->createdBy = 'kuni';

            $logPembayaran->save();
            return response()->json(['data'=>$logPembayaran])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getListLog($idPenelitian){
        try{
            $logPembayaran = LogPembayaran::where('idPenelitian', $idPenelitian)->get();
            return response()->json(['data'=>$logPembayaran])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getSingleLog($idPenelitian, $idLog){
        try{
            $logPembayaran = LogPembayaran::findOrFail($idLog);
            return response()->json(['data'=>$logPembayaran])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function deleteLog(){
        try{
            $logPembayaran = LogPembayaran::findOrFail($idLog);
            $logPembayaran->delete();
            return response()->json(['data'=>$logPembayaran])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }
    #endregion 
}
