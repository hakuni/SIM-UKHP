<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vwClientTrack;

class UserController extends Controller
{
    //
    public function getTracking($resi){
        try{
            $trackData = vwClientTrack::where('resi', $resi)->get();
            return response($trackData);
        }
        catch(\Exception $e){
            return response($e->getMessage());
        }
    }
}
