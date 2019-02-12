<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstPenelitian;
use App\vwPenelitian;


class PenelitianController extends Controller
{
    #region Master
    public function getListPenelitian()
    {
        try{
            $penelitian = vwPenelitian::All();
            return response()->json(['data'=>$penelitian])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()]);
        }
    }
    
    public function savePenelitian(Request $request)
    {
        try{
            $penelitian = $request->isMethod('put') ? MstPenelitian::findOrFail($request->idPenelitian) : new MstPenelitian;
            $penelitian->fill($request->all());
            
            if($request->isMethod('put'))
                $penelitian->updatedBy = 'kuni';
            else
                $penelitian->createdBy = 'kuni';

            $penelitian->save();
            return response()->json(['data'=>$penelitian])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function getSinglePenelitian($id)
    {
        try{
            $penelitian = vwPenelitian::findOrFail($id);
            return response()->json(['data'=>$penelitian])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getCode()])->setStatusCode(204);
        }
    }

    public function deletePenelitian($id)
    {
        try{
            $penelitian = MstPenelitian::findOrFail($id);

            $penelitian->delete();
            return response()->json(['data'=>$penelitian])->setStatusCode(200);

        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }
    #endregion
}
