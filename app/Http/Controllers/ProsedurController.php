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
            return response()->json(['data'=>$prosedur])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getProsedur($idProsedur){
        try{
            $prosedur = MstProsedur::findOrFail($idProsedur);
            return response()->json(['data'=>$prosedur])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }
    #endregion
}
