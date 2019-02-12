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
            // return (KategoriResource::collection($kategori))->response()->setStatusCode(200);
            return response()->json(['data'=>$kategori])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }

    public function saveKategori(Request $request)
    {
        //
        try{
            $kategori = $request->isMethod('put') ? MstKategori::findOrFail($request->idKategori) : new MstKategori;
            $kategori->fill($request->all());
            
            if($request->isMethod('put'))
                $kategori->updatedBy = 'kuni';
            else
                $kategori->createdBy = 'kuni';

            $kategori->save();
            return response()->json(['data'=>$kategori])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getSingleKategori($id)
    {
        //
        try{
            $kategori = MstKategori::findOrFail($id);
            return response()->json(['data'=>$kategori])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getCode()])->setStatusCode(204);
        }
    }

    public function deleteKategori($id)
    {
        //
        try{
            $kategori = MstKategori::findOrFail($id);

            $kategori->delete();
            return response()->json(['data'=>$kategori])->setStatusCode(200);

        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }
    #endregion
}
