<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vwClientTrack;

class UserController extends Controller
{
    //
    public function getTracking($idPenelitian){
        try{
            $trackData = vwClientTrack::where('idPenelitian', $idPenelitian)->get();
            return response($trackData);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }
}
