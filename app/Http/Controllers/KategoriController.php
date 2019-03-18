<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstKategori;

class KategoriController extends Controller
{
    #region Master
    public function getListKategori()
    {
        //
        try{
            $kategori = MstKategori::All();
            $kategori->ErrorType = 0;
            return response($kategori)->setStatusCode(200);
        }
        catch(\Exception $e){
            $kategori = new MstKategori;
            $kategori->ErrorType = 2;
            $kategori->ErrorMessage = $e->getMessage();
            return response($kategori)->setStatusCode(204);
        }
    }

    public function saveKategori(Request $request)
    {
        //
        try{
            $kategori = $request->isMethod('put') ? MstKategori::findOrFail($request->idKategori) : new MstKategori;
            $kategori->fill($request->all());
            
            if($request->isMethod('put'))
                $kategori->updatedBy = auth()->user()->email;
            else
                $kategori->createdBy = auth()->user()->email;

            $kategori->save();
            $kategori->ErrorType = 0;
            return response($kategori)->setStatusCode(200);
        }
        catch(\Exception $e){
            $kategori = new MstKategori;
            $kategori->ErrorType = 2;
            $kategori->ErrorMessage = $e->getMessage();
            return response($kategori)->setStatusCode(422);
        }
    }

    public function getSingleKategori($id)
    {
        //
        try{
            $kategori = MstKategori::findOrFail($id);
            $kategori->ErrorType = 0;
            return response($kategori)->setStatusCode(200);
        }
        catch(\Exception $e){
            $kategori = new MstKategori;
            $kategori->ErrorType = 2;
            $kategori->ErrorMessage = $e->getMessage();
            return response($kategori)->setStatusCode(204);
        }
    }

    public function deleteKategori($id)
    {
        //
        try{
            $kategori = MstKategori::findOrFail($id);

            $kategori->delete();
            $kategori->ErrorType = 0;
            return response($kategori)->setStatusCode(200);

        }
        catch(\Exception $e){
            $kategori = new MstKategori;
            $kategori->ErrorType = 2;
            $kategori->ErrorMessage = $e->getMessage();
            return response($kategori)->setStatusCode(204);
        }
    }
    #endregion
}
