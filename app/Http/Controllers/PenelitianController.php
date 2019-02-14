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
            $kategori->ErrorType = 0;
            return response($penelitian)->setStatusCode(200);
        }
        catch(\Exception $e){
            $penelitian = new MstPenelitian;
            $penelitian->ErrorType = 2;
            $penelitian->ErrorMessage = $e->getMessage();
            return response($penelitian)->setStatusCode(422);
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
}
