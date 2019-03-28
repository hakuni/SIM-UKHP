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
            $prosedur->fill($request->all());

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
