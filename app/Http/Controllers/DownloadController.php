<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstPenelitian;

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

            return response()->download(storage_path($filename))->deleteFileAfterSend(true);;
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function exportRincian($idPenelitian){

    }

    public function exportInventarisasi($idPenelitian){

    }

    public function downloadData($idPenelitian){

    }

    public function downloadAnalisis($idPenelitian){

    }
}
