<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstPenelitian;
use App\vwPenelitian;
use App\MstDataClient;
use App\LogTrxPenelitian;
use App\TrxPenelitian;

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
    private function saveTrx(Request $request){
        try{

        }
        catch(\Exception $e){
            
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
