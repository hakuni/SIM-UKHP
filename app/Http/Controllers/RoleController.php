<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstRole;

class RoleController extends Controller
{
    #region Master
    public function getListRole()
    {
        //
        try{
            $role = MstRole::All();
            $role->ErrorType = 0;
            return response($role)->setStatusCode(200);
        }
        catch(\Exception $e){
            $role = new MstRole;
            $role->ErrorType = 2;
            $role->ErrorMessage = $e->getMessage();
            return response($role)->setStatusCode(204);
        }
    }

    public function saveRole(Request $request)
    {
        //
        try{
            $role = $request->isMethod('put') ? MstRole::findOrFail($request->idRole) : new MstRole;
            $role->fill($request->all());
            
            if($request->isMethod('put'))
                $role->updatedBy = auth()->user()->email;
            else
                $role->createdBy = auth()->user()->email;

            $role->save();
            $role->ErrorType = 0;
            return response($role)->setStatusCode(200);
        }
        catch(\Exception $e){
            $role = new MstRole;
            $role->ErrorType = 2;
            $role->ErrorMessage = $e->getMessage();
            return response($role)->setStatusCode(422);
        }
    }

    public function getSingleRole($id)
    {
        //
        try{
            $role = MstRole::findOrFail($id);
            $role->ErrorType = 0;
            return response($role)->setStatusCode(200);
        }
        catch(\Exception $e){
            $role = new MstRole;
            $role->ErrorType = 2;
            $role->ErrorMessage = $e->getMessage();
            return response($role)->setStatusCode(204);
        }
    }

    public function deleteRole($id)
    {
        //
        try{
            $role = MstRole::findOrFail($id);

            $role->delete();
            $role->ErrorType = 0;
            return response($role)->setStatusCode(200);

        }
        catch(\Exception $e){
            $role = new MstRole;
            $role->ErrorType = 2;
            $role->ErrorMessage = $e->getMessage();
            return response($role)->setStatusCode(204);
        }
    }
    #endregion
}
