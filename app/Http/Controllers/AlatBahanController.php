<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstAlatBahan;
use App\LogAlatBahan;
use App\Http\Resources\AlatBahan as AlatBahanResource;

class AlatBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $alatBahan = MstAlatBahan::All();
            return (AlatBahanResource::collection($alatBahan))->response()->setStatusCode(200);
        }
        catch(\Exception $ex){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $alatBahan = $request->isMethod('put') ? MstAlatBahan::findOrFail($request->id) : new MstAlatBahan;
            $alatBahan->fill($request->all());
            
            if($request->isMethod('put'))
                $alatBahan->updatedBy = 'kuni';
            else
                $alatBahan->createdBy = 'kuni';

            $alatBahan->save();
            return (new AlatBahanResource($alatBahan))->response()->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $alatBahan = MstAlatBahan::findOrFail($id);
            return (new AlatBahanResource($alatBahan))->response()->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getCode()])->setStatusCode(204);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $alatBahan = MstAlatBahan::findOrFail($id);

            $alatBahan->delete();
            return (new PenelitianResource($alatBahan))->response()->setStatusCode(200);

        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }

    public function createTrx(Request $request){
        try{
            $logTrx = new LogAlatBahan;
            $logTrx->fill($request->all());
            $logTrx->createdBy = 'kuni';
            $logTrx->updatedBy = 'kuni';

            $logTrx->save();
            return (new AlatBahanResource($logTrx))->response()->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(422);
        }
    }

    public function logTrx($idAlatBahan){
        try{
            $log = LogAlatBahan::where('idAlatBahan', $idAlatBahan)->firstOrFail();
            return (new AlatBahanResource($log))->response()->setStatusCode(200);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getCode()])->setStatusCode(204);
        }
    }
}
