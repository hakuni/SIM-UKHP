<?php

namespace App\Http\Controllers\ControllerApis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\MstPenelitian;
use App\MstDataClient;
use App\MstMilestone;
use App\TrxPenelitian;
use App\LogTrxPenelitian;
use App\LogPemakaian;
use App\vwPenelitian;
use App\vwTrxPenelitian;
use App\vwRincian;
use App\vwHistory;

class PenelitianController extends Controller
{
    #region Master
    public function createPenelitian(Request $request)
    {
        try{
            $penelitian = new MstPenelitian;
            //save Data Client
            $dataClient = $this->saveDataClient($request);

            //save penelitian
            $penelitian->idKategori = $request->idKategori;
            $penelitian->idDataClient = $dataClient->idDataClient;
            $penelitian->statusPenelitian = $request->statusPenelitian;
            $penelitian->lastMilestoneID = 1;
            $penelitian->PIC = auth()->user()->email;
            $penelitian->createdBy = auth()->user()->email;
            $penelitian->resi = md5(microtime());
            $penelitian->save();

            //save Trx Log
            $trxLog = $this->saveTrxLog($penelitian->idPenelitian, "Pembuatan Prosedur", $penelitian->PIC);

            $penelitian->ErrorType = 0;
            return response($penelitian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $penelitian = new MstPenelitian;
            $penelitian->ErrorType = 2;
            $penelitian->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(422);
        }
    }

    public function editPenelitian(Request $request)
    {
        try{
            $penelitian = MstPenelitian::findOrFail($request->idPenelitian);

            //save data client
            $dataClient = $penelitian->dataClient()->first();
            $dataClient->namaPeneliti = $request->namaPeneliti;
            $dataClient->instansiPeneliti = $request->instansiPeneliti;
            $dataClient->telpPeneliti = $request->telpPeneliti;
            $dataClient->emailPeneliti = $request->emailPeneliti;
            $dataClient->alamatPeneliti = $request->alamatPeneliti;
            $dataClient->save();

            $penelitian->idKategori = $request->idKategori;
            $penelitian->updatedBy = auth()->user()->email;
            $penelitian->save();
            $penelitian->ErrorType = 0;

            return response($penelitian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $penelitian = new MstPenelitian;
            $penelitian->ErrorType = 2;
            $penelitian->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(422);
        }
    }

    public function getListPenelitian($email = null, $tracking = false)
    {
        try{
            if($email == null) //all penelitian
                if($tracking)
                    $penelitian = vwPenelitian::where('idKategori', '!=', 1)
                                    ->orderBy('updated_at', 'DESC')->get();
                else
                    $penelitian = vwPenelitian::orderBy('updated_at', 'DESC')->get();
            else //peneltiian by user
                $penelitian = vwPenelitian::where('email', $email)
                                ->where('idKategori', '!=', 1)
                                ->orderBy('updated_at', 'DESC')->get();
            $penelitian->ErrorType = 0;
            return response($penelitian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $penelitian = new vwPenelitian;
            $penelitian->ErrorType = 2;
            $penelitian->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(404);
        }
    }

    public function getSinglePenelitian($id)
    {
        try{
            $penelitian = vwPenelitian::findOrFail($id);
            $penelitian->ErrorType = 0;
            return response($penelitian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $penelitian = new vwPenelitian;
            $penelitian->ErrorType = 2;
            $penelitian->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(404);
        }
    }

    public function deletePenelitian($id)
    {
        try{
            $penelitian = MstPenelitian::findOrFail($id);

            $penelitian->delete();
            $penelitian->ErrorType = 0;
            return response($penelitian)->setStatusCode(200);

        }
        catch(\Exception $e){
            $penelitian = new MstPenelitian;
            $penelitian->ErrorType = 2;
            $penelitian->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(422);
        }
    }
    #endregion

    #region Transaction
    //simpan transaksi
    public function saveTrx(Request $request){
        try{
            //update mst penelitian
            $penelitian = MstPenelitian::findOrFail($request->idPenelitian);
            $penelitian->lastMilestoneID = $request->idMilestone+1;
            $penelitian->PIC = $request->PIC;

            //cek old trx
            $cek = TrxPenelitian::where('idPenelitian', $request->idPenelitian)->where('idMilestone', $request->idMilestone)->first();
            if($cek){ //trx done
                $trx = $cek;
                $trx->endDate = date('y-m-d');
                if($request->idMilestone == 3 || $request->idMilestone == 4){
                    //upload file
                    if($request->hasFile('doc')){
                        $upload = $this->uploadFile($request);
                        $trx->filePath = $upload;
                    }
                    $penelitian->statusPenelitian = 3;
                }
                $trx->catatan = $request->catatan;
                $trx->save(); //save old trx
                $trx->idMilestone = $trx->idMilestone+1;
                $transaksi = $trx;
            }

            if($request->idMilestone != 4){
                //create trx
                $transaksi = new TrxPenelitian;
                $prosedur = $penelitian->prosedur()->first(); //get durasi tahapan penelitian
                if($request->idMilestone == 1)
                    $transaksi->durasi = $prosedur->tahap1;
                else if($request->idMilestone == 2)
                    $transaksi->durasi = $prosedur->tahap2;
                else if($request->idMilestone == 3)
                    $transaksi->durasi = $prosedur->tahap3;

                $transaksi->idPenelitian = $request->idPenelitian;
                $transaksi->idMilestone = $request->idMilestone+1;
                $transaksi->startDate = date('y-m-d');
                $transaksi->createdBy = auth()->user()->email;
                $transaksi->PIC = $request->PIC;
                $penelitian->statusPenelitian = 2;

                $transaksi->save(); //save new trx
            }

            $penelitian->save();

            //save pemakaian hewan
            if($request->idMilestone == 1)
                $pemakaian = $this->savePemakaian($penelitian->idPenelitian);

            //save log trx
            $milestone = $transaksi->milestone()->first()->namaMilestone;
            $log = $this->saveTrxLog($request->idPenelitian, $milestone, $transaksi->PIC);

            return response($transaksi)->setStatusCode(200);
        }
        catch(\Exception $e){
            $transaksi = new TrxPenelitian;
            $transaksi->ErrorType = 2;
            $transaksi->ErrorMessage = $e->getMessage();
            return response($transaksi)->setStatusCode(422);

        }
    }

    public function batalTrx(Request $request){
        try{
            $penelitian = MstPenelitian::findOrFail($request->idPenelitian);
            $penelitian->statusPenelitian = 4;
            $penelitian->save();

            return response($penelitian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $penelitian = new MstPenelitian;
            $penelitian->ErrorType = 2;
            $penelitian->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(422);
        }
    }

    public function getDetailTrx($idPenelitian){
        try{
            $transaksi = vwTrxPenelitian::where('idPenelitian', $idPenelitian)->orderBy('updated_at', 'DESC')->first();
            return response($transaksi)->setStatusCode(200);
        }
        catch(\Exception $e){
            $transaksi = new vwTrxPenelitian;
            $transaksi->ErrorType = 2;
            $transaksi->ErrorMessage = $e->getMessage();
            return response($transaksi)->setStatusCode(404);
        }
    }

    public function getTrxLog($idPenelitian){
        try{
            $history = vwHistory::where('idPenelitian', $idPenelitian)->get();
            return response($history)->setStatusCode(200);
        }
        catch(\Exception $e){
            $history = new vwHistory;
            $history->ErrorType = 2;
            $history->ErrorMessage = $e->getMessage();
            return response($history)->setStatusCode(404);
        }
    }
    #endregion

    #region Private
    private function uploadFile(Request $request){
        try{
            $penelitian = MstPenelitian::findOrFail($request->idPenelitian);
            $judul = $peneltitian->prosedur()->first()->judulPenelitian;
            $dataClient = $penelitian->dataClient()->first();

            $metaFileName = $request->idMilestone == 3 ? "Data Pengujian " : "Analisis ";

            $file = $request->file('doc');
            $fileName = $metaFileName.$dataClient->namaPeneliti.'-'.$dataClient->instansiPeneliti;
            $fileName = date('mdYHis').'-'.$fileName.'.'.$file->getClientOriginalExtension();
            $file->move(public_path().'/uploads/', $fileName);
            $path = public_path().'/uploads/'.$fileName;

            return $path;
        }
        catch(\Exception $e){
            return response($e->getMessage())->setStatusCode(422);
        }
    }

    //insert ke tabel pemakaian
    private function savePemakaian($idPenelitian){
        try{
            //get alat bahan dari rincian where tipe != 3
            $rincian = vwRincian::where('idPenelitian', $idPenelitian)->where('tipeAlatBahan', '!=', 3)->get();
            
            $logPemakaian = array();
            //loop data
            foreach($rincian as $data){
                array_push($logPemakaian, array(
                            'namaAlatBahan' => $data->namaAlatBahan,
                            'tglTrx' => date('Y-m-d'),
                            'namaStatusPenggunaan' => 'Penelitian',
                            'jumlah' => $data->jumlah,
                            'createdBy' => auth()->user()->email,
                            'created_at' => date('Y-m-d'),
                            'updated_at' => date('Y-m-d')
                ));
            }
            LogPemakaian::insert($logPemakaian);
            return "success";
        }
        catch(\Exception $e){
            return response($e->getMessage())->setStatusCode(422);
        }
    }

    //simpan data client
    private function saveDataClient(Request $request){
        try{
            $dataClient = new MstDataClient;
            $dataClient->namaPeneliti = $request->namaPeneliti;
            $dataClient->instansiPeneliti = $request->instansiPeneliti;
            $dataClient->telpPeneliti = $request->telpPeneliti;
            $dataClient->emailPeneliti = $request->emailPeneliti;
            $dataClient->alamatPeneliti = $request->alamatPeneliti;

            $dataClient->save();
            return $dataClient;
        }
        catch(\Exception $e){
            return response($e->getMessage())->setStatusCode(422);
        }
    }

    //simpan log transaksi
    private function saveTrxLog($idPenelitian, $milestone, $PIC){
        try{
            $trxLog = new LogTrxPenelitian;
            $trxLog->idPenelitian = $idPenelitian;
            $trxLog->namaMilestone = $milestone;
            $trxLog->PIC = $PIC;
            $trxLog->createdDate = date("y-m-d");
            $trxLog->save();
            return $trxLog;
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
    #endregion
}
