<?php

namespace App\Http\Controllers\ControllerApis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MstAlatBahan;
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
            $keuangan->ErrorType = 0;
            return response($keuangan)->setStatusCode(200);
        }
        catch(\Exception $e){
            $keuangan = new vwKeuangan;
            $keuangan->ErrorType = 2;
            $keuangan->ErrorMessage = $e->getMessage();
            return response($keuangan)->setStatusCode(404);
        }
    }
    public function getSingleViewKeuangan($idPenelitian){
        try{
            $keuangan = vwKeuangan::where('idPenelitian', $idPenelitian);
            $keuangan->ErrorType = 0;
            return response($keuangan)->setStatusCode(200);
        }
        catch(\Exception $e){
            $keuangan = new vwKeuangan;
            $keuangan->ErrorType = 2;
            $keuangan->ErrorMessage = $e->getMessage();
            return response($keuangan)->setStatusCode(404);
        }
    }
    #endregion

    #region Rincian
    public function saveDetail(Request $request){
        try{
            $all = count($request->all());
            for($i=0; $i<$all; $i++){
                $rincian = new RincianBiaya;
                $rincian->idPenelitian = $request[$i]['idPenelitian'];
                $rincian->idMilestone = $request[$i]['namaMilestone'];
                $rincian->idAlatBahan = $request[$i]['namaAlatBahan'];
                $rincian->jumlah = $request[$i]['jumlah'];
                $rincian->harga = MstAlatBahan::findOrFail($request[$i]['namaAlatBahan'])->harga;
                $rincian->keterangan = $request[$i]['keterangan'];
                $rincian->createdBy = auth()->user()->email;
                $rincian->save();
            };

            $rincian->ErrorType = 0;
            return response($rincian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $rincian = new RincianBiaya;
            $rincian->ErrorType = 2;
            $rincian->ErrorMessage = $e->getMessage();
            return response($rincian)->setStatusCode(422);
        }
    }

    public function getListDetail($idPenelitian){
        try{
            $rincian = vwRincian::where('idPenelitian', $idPenelitian)->get();
            $rincian->ErrorType = 0;
            return response($rincian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $rincian = new vwRincian;
            $rincian->ErrorType = 2;
            $rincian->ErrorMessage = $e->getMessage();
            return response($rincian)->setStatusCode(404);
        }
    }

    public function getSingleDetail($idPenelitian, $idRincian){
        try{
            $rincian = vwRincian::findOrFail($idRincian);
            $rincian->ErrorType = 0;
            return response($rincian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $rincian = new vwRincian;
            $rincian->ErrorType = 2;
            $rincian->ErrorMessage = $e->getMessage();
            return response($rincian)->setStatusCode(404);
        }
    }

    public function editDetail(Request $request){
        try{
            $rincian = RincianBiaya::findOrFail($request->idRincianBiaya);

            $rincian->idAlatBahan = $request->namaAlatBahan;
            $rincian->jumlah = $request->jumlah;

            $rincian->updatedBy = auth()->user()->email;
            $rincian->save();
            $rincian->ErrorType = 0;
            return response($rincian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $rincian = new RincianBiaya;
            $rincian->ErrorType = 2;
            $rincian->ErrorMessage = $e->getMessage();
            return response($rincian)->setStatusCode(422);
        }
    }

    public function deleteDetail($idRincian){
        try{
            $rincian = RincianBiaya::findOrFail($idRincian);
            $rincian->delete();
            $rincian->ErrorType = 0;
            return response($rincian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $rincian = new RincianBiaya;
            $rincian->ErrorType = 2;
            $rincian->ErrorMessage = $e->getMessage();
            return response($rincian)->setStatusCode(422);
        }
    }
    #endregion

    #region Log Pembayaran
    public function saveLog(Request $request){
        try{
            $logPembayaran = new LogPembayaran;

            $logPembayaran->idPenelitian = $request->idPenelitian;
            $logPembayaran->tglPembayaran = date("y-m-d", strtotime($request->tglPembayaran));
            $logPembayaran->totalPembayaran = $request->totalPembayaran;
            $logPembayaran->createdBy = auth()->user()->email;

            $logPembayaran->save();
            $logPembayaran->ErrorType = 0;
            return response($logPembayaran)->setStatusCode(200);
        }
        catch(\Exception $e){
            $logPembayaran = new LogPembayaran;
            $logPembayaran->ErrorType = 2;
            $logPembayaran->ErrorMessage = $e->getMessage();
            return response($logPembayaran)->setStatusCode(422);
        }
    }

    public function getListLog($idPenelitian){
        try{
            $logPembayaran = LogPembayaran::where('idPenelitian', $idPenelitian)->get();
            $logPembayaran->ErrorType = 0;
            return response($logPembayaran)->setStatusCode(200);
        }
        catch(\Exception $e){
            $logPembayaran = new LogPembayaran;
            $logPembayaran->ErrorType = 2;
            $logPembayaran->ErrorMessage = $e->getMessage();
            return response($logPembayaran)->setStatusCode(404);
        }
    }

    public function getSingleLog($idPenelitian, $idLog){
        try{
            $logPembayaran = LogPembayaran::findOrFail($idLog);
            $logPembayaran->ErrorType = 0;
            return response($logPembayaran)->setStatusCode(200);
        }
        catch(\Exception $e){
            $logPembayaran = new LogPembayaran;
            $logPembayaran->ErrorType = 2;
            $logPembayaran->ErrorMessage = $e->getMessage();
            return response($logPembayaran)->setStatusCode(404);
        }
    }

    public function editLog(Request $request){
        try{
            $logPembayaran = LogPembayaran::findOrFail($request->idPenelitian);

            $logPembayaran->tglPembayaran = date("y-m-d", strtotime($request->tglPembayaran));
            $logPembayaran->totalPembayaran = $request->totalPembayaran;
            $logPembayaran->createdBy = auth()->user()->email;

            $logPembayaran->save();
            $logPembayaran->ErrorType = 0;
            return response($logPembayaran)->setStatusCode(200);
        }
        catch(\Exception $e){
            $logPembayaran = new LogPembayaran;
            $logPembayaran->ErrorType = 2;
            $logPembayaran->ErrorMessage = $e->getMessage();
            return response($logPembayaran)->setStatusCode(422);
        }
    }

    public function deleteLog($idLog){
        try{
            $logPembayaran = LogPembayaran::findOrFail($idLog);
            $logPembayaran->delete();
            $logPembayaran->ErrorType = 0;
            return response($logPembayaran)->setStatusCode(200);
        }
        catch(\Exception $e){
            $logPembayaran = new LogPembayaran;
            $logPembayaran->ErrorType = 2;
            $logPembayaran->ErrorMessage = $e->getMessage();
            return response($logPembayaran)->setStatusCode(422);
        }
    }
    #endregion
}
