<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstStatusPenelitian;

class StatusPenelitianController extends Controller
{
    #region Master
    public function getListStatus()
    {
        //
        try{
            $status = MstStatusPenelitian::All();
            $status->ErrorType = 0;
            return response($status)->setStatusCode(200);
        }
        catch(\Exception $e){
            $status = new MstStatusPenelitian;
            $status->ErrorType = 2;
            $status->ErrorMessage = $e->getMessage();
            return response($status)->setStatusCode(204);
        }
    }

    public function saveStatus(Request $request)
    {
        //
        try{
            $status = $request->isMethod('put') ? MstStatusPenelitian::findOrFail($request->idStatusPenelitian) : new MstStatusPenelitian;
            $status->fill($request->all());
            
            if($request->isMethod('put'))
                $status->updatedBy = auth()->user()->email;
            else
                $status->createdBy = auth()->user()->email;

            $status->save();
            $status->ErrorType = 0;
            return response($status)->setStatusCode(200);
        }
        catch(\Exception $e){
            $status = new MstStatusPenelitian;
            $status->ErrorType = 2;
            $status->ErrorMessage = $e->getMessage();
            return response($status)->setStatusCode(422);
        }
    }

    public function getSingleStatus($id)
    {
        //
        try{
            $status = MstStatusPenelitian::findOrFail($id);
            $status->ErrorType = 0;
            return response($status)->setStatusCode(200);
        }
        catch(\Exception $e){
            $status = new MstStatusPenelitian;
            $status->ErrorType = 2;
            $status->ErrorMessage = $e->getMessage();
            return response($status)->setStatusCode(204);
        }
    }

    public function deleteStatus($id)
    {
        //
        try{
            $status = MstStatusPenelitian::findOrFail($id);

            $status->delete();
            $status->ErrorType = 0;
            return response($status)->setStatusCode(200);

        }
        catch(\Exception $e){
            $status = new MstStatusPenelitian;
            $status->ErrorType = 2;
            $status->ErrorMessage = $e->getMessage();
            return response($status)->setStatusCode(204);
        }
    }
    #endregion
}
