<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\MstPenelitian;
use App\vwPenelitian;
use App\MstDataClient;
use App\LogTrxPenelitian;
use App\TrxPenelitian;
use App\vwTrxPenelitian;
use App\MstMilestone;
use App\vwRincian;
use App\LogPemakaian;

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

    public function getListPenelitian($order = 1)
    {
        try{
            if($order == 1)
                $penelitian = vwPenelitian::orderBy('updated_at', 'DESC')->get();
            else
                $penelitian = vwPenelitian::where('PIC', 'kuni')->orderBy('updated_at', 'DESC')->get();
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
            $penelitian = MstPenelitian::findOrFail($request->idPenelitian);
            $penelitian->lastMilestoneID = $request->idMilestone+1;

            //cek old trx
            $cek = TrxPenelitian::where('idPenelitian', $request->idPenelitian)->where('idMilestone', $request->idMilestone)->first();
            if($cek){ //trx done
                $trx = $cek;
                $trx->endDate = date('y-m-d');
                if($request->idMilestone == 4){
                    //upload file
                    if($request->hasFile('doc')){
                        $upload = $this->uploadFile($request);
                        $trx->fileDataPath = $upload;
                    }
                    $penelitian->statusPenelitian = 3;
                }

                $trx->save(); //save old trx
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
                $transaksi->createdBy = 'kuni';
                $transaksi->PIC = $penelitian->PIC;
                $transaksi->catatan = $request->catatan;
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
            $transaksi = new TrxPenelitian;
            $transaksi->ErrorType = 2;
            $transaksi->ErrorMessage = $e->getMessage();
            return response($transaksi)->setStatusCode(422);
        }
    }

    public function uploadFile(Request $request){
        $file = $request->file('doc');
        $fileName = date('mdYHis').$file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
        $image['filePath'] = $fileName;
        $file->move(public_path().'/uploads/', $fileName);
        $path = public_path().'/uploads/'.$fileName;
        if($request->idTrx != null){
            try{
                $trx = TrxPenelitian::findOrFail($request->idTrx);
                $trx->fileAnalisisPath = $path;

                $trx->save();
                return response($trx)->setStatusCode(200);
            }
            catch(\Exception $e){
                $trx = new TrxPenelitian;
                $trx->ErrorType = 2;
                $trx->ErrorMessage = $e->getMessage();
                return response($trx)->setStatusCode(422);
            }
        }
        return $path;
    }
    #endregion

    #region Private
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
                            'jumlah' => $data->jumlah,
                            'createdBy' => 'kuni',
                            'created_at' => date('Y-m-d'),
                            'updated_at' => date('Y-m-d')
                ));
            }
            LogPemakaian::insert($logPemakaian);
            return "success";
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }public function getSingleViewKeuangan($idPenelitian){
        try{
            $keuangan = vwKeuangan::where('idPenelitian', $idPenelitian);
            $keuangan->ErrorType = 0;
            return response($keuangan)->setStatusCode(200);
        }
        catch(\Exception $e){
            $keuangan = new vwKeuangan;
            $keuangan->ErrorType = 2;
            $keuangan->ErrorMessage = $e->getMessage();
            return response($keuangan)->setStatusCode(204);
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
