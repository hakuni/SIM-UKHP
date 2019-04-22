<?php

namespace App\Http\Controllers\ControllerApis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MstProsedur;

class ProsedurController extends Controller
{
    #region Prosedur
    public function saveProsedur(Request $request){
        try{
            $prosedur = $request->isMethod('post') ? new MstProsedur : MstProsedur::findOrFail($request->idProsedur);
            $prosedur->fill($request->except(['tipe1', 'tipe2', 'tipe3', 'tipe4']));

            if($request->tipe1 != 1)
                $prosedur->tahap1 = $request->tahap1 * 7;
            if($request->tipe2 != 1)
                $prosedur->tahap2 = $request->tahap2 * 7;
            if($request->tipe3 != 1)
                $prosedur->tahap3 = $request->tahap3 * 7;
            if($request->tipe4 != 1)
                $prosedur->tahap4 = $request->tahap4 * 7;

            if($request->isMethod('put'))
                $prosedur->updatedBy = auth()->user()->email;
            else
                $prosedur->createdBy = auth()->user()->email;

            $prosedur->save();
            return response($prosedur)->setStatusCode(200);
        }
        catch(\Exception $e){
            $prosedur = new MstProsedur;
            $prosedur->ErrorType = 2;
            $prosedur->ErrorMessage = $e->getMessage();
            return response($prosedur)->setStatusCode(422);
        }
    }

    public function getProsedur($idProsedur){
        try{
            $prosedur = MstProsedur::findOrFail($idProsedur);
            return response($prosedur)->setStatusCode(200);
        }
        catch(\Exception $e){
            $prosedur = new MstProsedur;
            $prosedur->ErrorType = 2;
            $prosedur->ErrorMessage = $e->getMessage();
            return response($prosedur)->setStatusCode(404);
        }
    }
    #endregion
}
