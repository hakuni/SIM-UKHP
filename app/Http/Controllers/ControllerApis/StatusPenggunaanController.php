<?php

namespace App\Http\Controllers\ControllerApis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MstStatusPenggunaan;

class StatusPenggunaanController extends Controller
{
    #region Master
    public function getListStatusPenggunaan()
    {
        //
        try{
            $statusPenggunaan = MstStatusPenggunaan::All();
            $statusPenggunaan->ErrorType = 0;
            return response($statusPenggunaan)->setStatusCode(200);
        }
        catch(\Exception $e){
            $statusPenggunaan = new MstStatusPenggunaan;
            $statusPenggunaan->ErrorType = 2;
            $statusPenggunaan->ErrorMessage = $e->getMessage();
            return response($statusPenggunaan)->setStatusCode(404);
        }
    }

    public function saveStatusPenggunaan(Request $request)
    {
        //
        try{
            $statusPenggunaan = $request->isMethod('put') ? MstStatusPenggunaan::findOrFail($request->idStatusPenggunaan) : new MstStatusPenggunaan;
            $statusPenggunaan->fill($request->all());
            
            if($request->isMethod('put'))
                $statusPenggunaan->updatedBy = auth()->user()->email;
            else
                $statusPenggunaan->createdBy = auth()->user()->email;

            $statusPenggunaan->save();
            $statusPenggunaan->ErrorType = 0;
            return response($statusPenggunaan)->setStatusCode(200);
        }
        catch(\Exception $e){
            $statusPenggunaan = new MstStatusPenggunaan;
            $statusPenggunaan->ErrorType = 2;
            $statusPenggunaan->ErrorMessage = $e->getMessage();
            return response($statusPenggunaan)->setStatusCode(422);
        }
    }

    public function getSingleStatusPenggunaan($id)
    {
        //
        try{
            $statusPenggunaan = MstStatusPenggunaan::findOrFail($id);
            $statusPenggunaan->ErrorType = 0;
            return response($statusPenggunaan)->setStatusCode(200);
        }
        catch(\Exception $e){
            $statusPenggunaan = new MstStatusPenggunaan;
            $statusPenggunaan->ErrorType = 2;
            $statusPenggunaan->ErrorMessage = $e->getMessage();
            return response($statusPenggunaan)->setStatusCode(404);
        }
    }

    public function deleteStatusPenggunaan($id)
    {
        //
        try{
            $statusPenggunaan = MstStatusPenggunaan::findOrFail($id);

            $statusPenggunaan->delete();
            $statusPenggunaan->ErrorType = 0;
            return response($statusPenggunaan)->setStatusCode(200);

        }
        catch(\Exception $e){
            $statusPenggunaan = new MstStatusPenggunaan;
            $statusPenggunaan->ErrorType = 2;
            $statusPenggunaan->ErrorMessage = $e->getMessage();
            return response($statusPenggunaan)->setStatusCode(422);
        }
    }
    #endregion
}
