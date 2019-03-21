<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstMilestone;

class MilestoneController extends Controller
{
    #region Master
    public function getListMilestone()
    {
        //
        try{
            $milestone = MstMilestone::All();
            $milestone->ErrorType = 0;
            return response($milestone)->setStatusCode(200);
        }
        catch(\Exception $e){
            $milestone = new MstMilestone;
            $milestone->ErrorType = 2;
            $milestone->ErrorMessage = $e->getMessage();
            return response($milestone)->setStatusCode(204);
        }
    }

    public function saveMilestone(Request $request)
    {
        //
        try{
            $milestone = $request->isMethod('put') ? MstMilestone::findOrFail($request->idMilestone) : new MstMilestone;
            $milestone->fill($request->all());
            
            if($request->isMethod('put'))
                $milestone->updatedBy = auth()->user()->email;
            else
                $milestone->createdBy = auth()->user()->email;

            $milestone->save();
            $milestone->ErrorType = 0;
            return response($milestone)->setStatusCode(200);
        }
        catch(\Exception $e){
            $milestone = new MstMilestone;
            $milestone->ErrorType = 2;
            $milestone->ErrorMessage = $e->getMessage();
            return response($milestone)->setStatusCode(422);
        }
    }

    public function getSingleMilestone($id)
    {
        //
        try{
            $milestone = MstMilestone::findOrFail($id);
            $milestone->ErrorType = 0;
            return response($milestone)->setStatusCode(200);
        }
        catch(\Exception $e){
            $milestone = new MstMilestone;
            $milestone->ErrorType = 2;
            $milestone->ErrorMessage = $e->getMessage();
            return response($milestone)->setStatusCode(204);
        }
    }

    public function deleteMilestone($id)
    {
        //
        try{
            $milestone = MstMilestone::findOrFail($id);

            $milestone->delete();
            $milestone->ErrorType = 0;
            return response($milestone)->setStatusCode(200);

        }
        catch(\Exception $e){
            $milestone = new MstMilestone;
            $milestone->ErrorType = 2;
            $milestone->ErrorMessage = $e->getMessage();
            return response($milestone)->setStatusCode(204);
        }
    }
    #endregion
}
