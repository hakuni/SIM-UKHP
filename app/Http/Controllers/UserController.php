<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\vwClientTrack;
use App\User;

class UserController extends Controller
{
    #region master
    public function createUser(Request $request){
        try{
            $user = new User;
            $user->namaUser = $request->namaUser;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // $token = $user->createToken('UserToken')->accessToken;

            // return response($token);
            return response($user);
        }
        catch(\Exception $e){
            $user = new User;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user);
        }
    }

    public function getAllUser(){
        try{
            $user = User::all();
            $user->ErrorType = 0;
            return response($user);
        }
        catch(\Exception $e){
            $user = new User;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user);
        }
    }

    public function getSingleUser($idUser){
        try{
            $user = User::findOrFail($idUser);
            return response($user);
        }
        catch(\Exception $e){
            $user = new User;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user);
        }
    }

    public function editUser(Request $request){
        try{
            $user = User::findOrFail($request->idUser);
            $user->namaUser = $request->namaUser;
            $user->email = $request->email;
            if($request->password != null)
                $user->password = Hash::make($request->password);
            $user->save();

            return response($user);
        }
        catch(\Exception $e){
            $user = new User;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user);
        }
    }

    public function deleteUser($idUser){
        try{
            $user = User::findOrFail($idUser);
            $user->delete();
            return response($user);
        }
        catch(\Exception $e){
            $user = new User;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user);
        }
    }
    #endregion

    #region auth
    public function loginUser(Request $request){
        try{
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
            
            $test = auth()->attempt($credentials);
            
            $token = auth()->user()->createToken('UserToken')->accessToken;

            return response($token);
            
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }    
    #endregion

    #region client
    public function getTracking($resi){
        try{
            $trackData = vwClientTrack::where('resi', $resi)->get();
            return response($trackData);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }
    #endregion
}
