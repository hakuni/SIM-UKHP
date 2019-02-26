<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstPenelitian;
use App\vwPenelitian;
use App\MstDataClient;
use App\LogTrxPenelitian;
use App\TrxPenelitian;
use App\MstMilestone;

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
            $penelitian->PIC = 'kuni';
            $penelitian->createdBy = 'kuni';
            $penelitian->save();

            //save Trx Log
            $trxLog = $this->saveTrxLog($penelitian->idPenelitian, "Pembuatan Prosedur", "kuni");

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
            $dataClient = MstDataClient::findOrFail($penelitian->idDataClient);
            $dataClient->namaPeneliti = $request->namaPeneliti;
            $dataClient->instansiPeneliti = $request->instansiPeneliti;
            $dataClient->telpPeneliti = $request->telpPeneliti;
            $dataClient->emailPeneliti = $request->emailPeneliti;
            $dataClient->alamatPeneliti = $request->alamatPeneliti;
            $dataClient->save();

            $penelitian->idKategori = $request->idKategori;
            $penelitian->updatedBy = 'kuni';
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

    public function getListPenelitian()
    {
        try{
            $penelitian = vwPenelitian::All();
            $penelitian->ErrorType = 0;
            return response($penelitian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $penelitian = new vwPenelitian;
            $penelitian->ErrorType = 2;
            $penelitian->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(204);
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
            return response($penelitian)->setStatusCode(204);
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
            $penelitian = MstPenelitian::findOrFail($request->idPenelitian)->first();
            $penelitian->lastMilestoneID = $request->idMilestone+1;
            $penelitian->PIC = "kuni";

            //cek old trx
            $cek = TrxPenelitian::where('idPenelitian', $request->idPenelitian)->where('idMilestone', $request->idMilestone)->first();
            if($cek){ //trx done
                $trx = $cek;
                $trx->endDate = date('y-m-d');
                if($request->idMilestone == 4){
                    //upload file
                    if($request->hasFile('doc')){
                        $file = $request->file('doc');
                        $fileName = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
                        $image['filePath'] = $fileName;
                        $file->move(public_path().'/uploads/', $fileName);
                        $trx->filePath = public_path().'/uploads/'.$fileName;
                    }
                    $penelitian->statusPenelitian = 3;
                }

                $trx->save(); //save old trx
                $transaksi = $trx;
            }

            if($request->idMilestone != 4){
                //create trx
                $transaksi = new TrxPenelitian;
                $transaksi->idPenelitian = $request->idPenelitian;
                $transaksi->idMilestone = $request->idMilestone+1;
                $transaksi->startDate = date('y-m-d');
                $transaksi->createdBy = 'kuni';
                $transaksi->PIC = $request->PIC;
                $transaksi->durasi = $request->durasi;
                $transaksi->catatan = $request->catatan;
                $penelitian->statusPenelitian = 2;

                $transaksi->save(); //save new trx
            }
            
            
            $penelitian->save();

            //save log trx
            $milestone = MstMilestone::where('idMilestone', $penelitian->lastMilestoneID)->first();
            $log = $this->saveTrxLog($request->idPenelitian, $milestone->namaMilestone, $transaksi->PIC);

            return response($transaksi)->setStatusCode(200);
        }
        catch(\Exception $e){
            $transaksi = new TrxPenelitian;
            $transaksi->ErrorType = 2;
            $transaksi->ErrorMessage = $e->getMessage();
            return response($transaksi)->setStatusCode(422);

        }
    }

    public function getListTrx($idPenelitian){
        try{
            $transaksi = TrxPenelitian::where('idPenelitian', $idPenelitian)->get();
            return response($transaksi)->setStatusCode(200);
        }
        catch(\Exception $e){
            $transaksi = new TrxPenelitian;
            $transaksi->ErrorType = 2;
            $transaksi->ErrorMessage = $e->getMessage();
            return response($transaksi)->setStatusCode(422);
        }
    }
    #endregion

    #region Private
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
            return $e->getMessage();
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
