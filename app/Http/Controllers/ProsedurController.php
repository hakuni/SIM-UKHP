<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstProsedur;

class ProsedurController extends Controller
{
    #region Prosedur
    public function saveProsedur(Request $request){
        try{
            $prosedur = $request->isMethod('post') ? new MstProsedur : MstProsedur::findOrFail($request->idProsedur);
            $prosedur->fill($request->all());

            if($request->isMethod('put'))
                $prosedur->updatedBy = 'kuni';
            else
                $prosedur->createdBy = 'kuni';

            $prosedur->save();
            return response($prosedur)->setStatusCode(200);
        }
        catch(\Exception $e){
            $prosedur = new MstProsedur;
            $prosedur->ErrorType = 2;
            $prosedur->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(422);
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
            return response($penelitian)->setStatusCode(422);
        }
    }
    #endregion
}
