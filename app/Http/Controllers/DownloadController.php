<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstPenelitian;
use App\TrxPenelitian;
use App\MstMilestone;
use App\vwRincian;

class DownloadController extends Controller
{
    public function exportProsedur($idPenelitian){
        try{
            //get data
            $penelitian = MstPenelitian::findOrFail($idPenelitian);
            $dataClient = $penelitian->dataClient()->first();
            $prosedur = $penelitian->prosedur()->first();
            $namaKategori = $penelitian->kategori()->first()->namaKategori;
            $namaHewan = $prosedur->alatBahan()->first()->namaAlatBahan;

            //$replace = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $replace);

            $perlakuan = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $prosedur->perlakuan);
            $parameterUji = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $prosedur->parameterUji);
            $desainPenelitian = preg_replace('~\R~u', '</w:t><w:br/><w:t>', $prosedur->desainPenelitian);

            $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('template_prosedur.docx'));
            $template->setValue('namaPeneliti', $dataClient->namaPeneliti);
            $template->setValue('instansiPeneliti', $dataClient->instansiPeneliti);
            $template->setValue('judulPenelitian', $prosedur->judulPenelitian);
            $template->setValue('namaKategori', $namaKategori);
            $template->setValue('namaHewan', $namaHewan);
            $template->setValue('perlakuan', $perlakuan);
            $template->setValue('parameterUji', $parameterUji);
            $template->setValue('desainPenelitian', $desainPenelitian);

            $filename = 'Prosedur Penelitian '.$dataClient->namaPeneliti.'-'.$dataClient->instansiPeneliti.'.docx';

            $template->saveAs(storage_path($filename));

            return response()->download(storage_path($filename))->deleteFileAfterSend(true);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function exportRincian($idPenelitian){
        try{
            $penelitian = MstPenelitian::findOrFail($idPenelitian);
            $dataClient = $penelitian->dataClient()->first();
            $prosedur = $penelitian->prosedur()->first();
            $rincian1 = vwRincian::where('idPenelitian', $idPenelitian)->where('idMilestone', 2)->get();
            $rincian2 = vwRincian::where('idPenelitian', $idPenelitian)->where('idMilestone', 3)->get();
            $rincian3 = vwRincian::where('idPenelitian', $idPenelitian)->where('idMilestone', 4)->get();
    
            $sum = 0;

            $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('template_invoice.docx'));
            $template->setValue('tahun', date('Y'));
            $template->setValue('namaPeneliti', $dataClient->namaPeneliti);
            $template->setValue('namaMilestone1', $rincian1[0]->namaMilestone);
            $durasi = ceil($prosedur->tahap1/7);
            $template->setValue('tahap1', $durasi);
            //clone row table1
            $template->cloneRow('namaAlatBahan1', count($rincian1));
            for($number = 0; $number < count($rincian1); $number++) {
                $template->setValue('namaAlatBahan1#'.($number+1), htmlspecialchars($rincian1[$number]->namaAlatBahan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('jumlah1#'.($number+1), htmlspecialchars($rincian1[$number]->jumlah, ENT_COMPAT, 'UTF-8'));
                $template->setValue('satuan1#'.($number+1), htmlspecialchars($rincian1[$number]->satuan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('harga1#'.($number+1), htmlspecialchars('Rp. '.number_format($rincian1[$number]->harga,0,',','.').',-'.'/'.$rincian1[$number]->satuan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('subtotal1#'.($number+1), htmlspecialchars('Rp. '.number_format($rincian1[$number]->total,0,',','.').',-', ENT_COMPAT, 'UTF-8'));
                $sum += $rincian1[$number]->total;
            }
    
            $template->setValue('namaMilestone2', $rincian2[0]->namaMilestone);
            $durasi = ceil($prosedur->tahap2/7);
            $template->setValue('tahap2', $durasi);
            //clone row table2
            $template->cloneRow('namaAlatBahan2', count($rincian2));
            //loop
            for($number = 0; $number < count($rincian2); $number++) {
                $template->setValue('namaAlatBahan2#'.($number+1), htmlspecialchars($rincian2[$number]->namaAlatBahan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('jumlah2#'.($number+1), htmlspecialchars($rincian2[$number]->jumlah, ENT_COMPAT, 'UTF-8'));
                $template->setValue('satuan2#'.($number+1), htmlspecialchars($rincian2[$number]->satuan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('harga2#'.($number+1), htmlspecialchars('Rp. '.number_format($rincian2[$number]->harga,0,',','.').',-'.'/'.$rincian2[$number]->satuan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('subtotal2#'.($number+1), htmlspecialchars('Rp. '.number_format($rincian2[$number]->total,0,',','.').',-', ENT_COMPAT, 'UTF-8'));
                $sum += $rincian2[$number]->total;
            }
            
            $template->setValue('namaMilestone3', $rincian3[0]->namaMilestone);
            $durasi = ceil($prosedur->tahap3/7);
            $template->setValue('tahap3', $durasi);
            //clone row table3
            $template->cloneRow('namaAlatBahan3', count($rincian3));
            //loop
            for($number = 0; $number < count($rincian3); $number++) {
                $template->setValue('namaAlatBahan3#'.($number+1), htmlspecialchars($rincian3[$number]->namaAlatBahan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('jumlah3#'.($number+1), htmlspecialchars($rincian3[$number]->jumlah, ENT_COMPAT, 'UTF-8'));
                $template->setValue('satuan3#'.($number+1), htmlspecialchars($rincian3[$number]->satuan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('harga3#'.($number+1), htmlspecialchars('Rp. '.number_format($rincian3[$number]->harga,0,',','.').',-'.'/'.$rincian3[$number]->satuan, ENT_COMPAT, 'UTF-8'));
                $template->setValue('subtotal3#'.($number+1), htmlspecialchars('Rp. '.number_format($rincian3[$number]->total,0,',','.').',-', ENT_COMPAT, 'UTF-8'));
                $sum += $rincian3[$number]->total;
            }   
            $template->setValue('subtotal3', $sum);
            
            $pajak = $sum * 10 / 100;
            $final = $sum + $pajak;

            $template->setValue('sum', 'Rp. '.number_format($sum,0,',','.').',-');
            $template->setValue('pajak', 'Rp. '.number_format($pajak,0,',','.').',-');
            $template->setValue('total', 'Rp. '.number_format($final,0,',','.').',-');
            $template->setValue('tanggal', date('d-M-Y'));
    
            $filename = 'Invoice Penelitian '.$dataClient->namaPeneliti.'-'.$dataClient->instansiPeneliti.'.docx';
    
            $template->saveAs(storage_path($filename));
    
            return response()->download(storage_path($filename))->deleteFileAfterSend(true);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function exportInventarisasi(){

    }

    public function downloadData($idPenelitian){
        try{
            $data = TrxPenelitian::where('idPenelitian', $idPenelitian)->where('idMilestone', 4)->first();
            $path = $data->filePath;
            return response()->download($path);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function downloadAnalisis($idPenelitian){
        try{
            $data = TrxPenelitian::where('idPenelitian', $idPenelitian)->where('idMilestone', 4)->first();
            $path = $data->filePath;
            return response()->download($path);
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
}

