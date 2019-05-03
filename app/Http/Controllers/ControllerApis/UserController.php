<?php

namespace App\Http\Controllers\ControllerApis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\vwClientTrack;
use App\User;
use App\vwUser;
use App\vwNotifikasi;

class UserController extends Controller
{
    #region master
    public function createUser(Request $request){
        try{
            $user = new User;
            $user->namaUser = $request->namaUser;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->idRole = $request->idRole;
            $user->save();

            // $token = $user->createToken('UserToken')->accessToken;

            // return response($token);
            return response($user);
        }
        catch(\Exception $e){
            $user = new User;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user)->setStatusCode(422);
        }
    }

    public function getAllUser(){
        try{
            $user = vwUser::all();
            $user->ErrorType = 0;
            return response($user);
        }
        catch(\Exception $e){
            $user = new vwUser;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user)->setStatusCode(404);
        }
    }

    public function getSingleUser($idUser){
        try{
            $user = vwUser::where('id', $idUser)->first();
            return response($user);
        }
        catch(\Exception $e){
            $user = new vwUser;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user)->setStatusCode(404);
        }
    }

    public function editUser(Request $request){
        try{
            $cek = User::where('id', '!=', $request->id)->where('email', $request->email)->first();
            if($cek){
                $cek = new User;
                $cek->ErrorType = 1;
                $cek->ErrorMessage = "Email sudah digunakan";
                return response($cek);
            }

            $user = User::findOrFail($request->id);
            $user->namaUser = $request->namaUser;
            $user->email = $request->email;
            $user->idRole = $request->idRole;
            if($request->password != null)
                $user->password = Hash::make($request->password);
            $user->save();
            $user->ErrorType = 0;
            return response($user);
        }
        catch(\Exception $e){
            $user = new User;
            $user->ErrorType = 2;
            $user->ErrorMesasge = $e->getMessage();
            return response($user)->setStatusCode(422);
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
            return response($user)->setStatusCode(422);
        }
    }

    public function getNotificationLog($statusTelat){
        try{
            $user = auth()->user();
            $notifLog = vwNotifikasi::where('statusTelat', $statusTelat)
                            ->where('PIC', $user->email)
                            ->where('idMilestone', '!=', 5)->get();
            $total = count(vwNotifikasi::where('idMilestone', '!=', 5)
                                        ->where('PIC', auth()->user()->email)->get());
            if(count($notifLog))
                $notifLog[0]->total = $total;
            return response($notifLog);
        }
        catch(\Exception $e){
            $notifLog = new vwNotifikasi;
            $notifLog->ErrorCode = 2;
            $notifLog->ErrorMessage = $e->getMessage();
            return response($notifLog)->setStatusCode(404);
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

            if($test){
                $token = auth()->user()->createToken('UserToken')->accessToken;
                $auth = auth()->user();

                $role = $auth->role()->first();

                return response()->json(['token' => $token, 'idUser'=> $auth->id, 'namaUser' => $auth->namaUser,
                                        'role' =>$role->idRole, 'namaRole' => $role->namaRole])
                                ->withCookie(cookie()->forever('access_token', $token))
                                ->withCookie(cookie()->forever('email', $auth->email));
            }
            else
                return response()->json(['message'=>'Login Gagal'])->setStatusCode(422);
        }
        catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(422);
        }
    }
    public function logoutUser(){
        try{
            $user = auth()->user()->token();
            $user->revoke();
            $user->delete();
            return response('Successfully Logged Out');
        }
        catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(422);
        }
    }
    public function cekToken(){
        try{
            $user = auth();
            return response()->json(['message' => 'Selamat datang kembali'])->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(404);
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
            return response()->json(['message' => $e->getMessage()])->setStatusCode(404);
        }
    }
    #endregion
}
