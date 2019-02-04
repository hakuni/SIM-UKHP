<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstPenelitian;
use App\Http\Resources\Penelitian as PenelitianResource;


class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $penelitian = MstPenelitian::All();
            return (PenelitianResource::collection($penelitian))->response()->setStatusCode(200);
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
            $penelitian = $request->isMethod('put') ? MstPenelitian::findOrFail($request->id) : new MstPenelitian;
            $penelitian->fill($request->all());
            
            if($request->isMethod('put'))
                $penelitian->updatedBy = 'kuni';
            else
                $penelitian->createdBy = 'kuni';

            $penelitian->save();
            return (new PenelitianResource($penelitian))->response()->setStatusCode(200);
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
            $penelitian = MstPenelitian::findOrFail($id);
            return (new PenelitianResource($penelitian))->response()->setStatusCode(200);
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
            $penelitian = MstPenelitian::findOrFail($id);

            $penelitian->delete();
            return (new PenelitianResource($penelitian))->response()->setStatusCode(200);

        }
        catch(\Exception $e){
            return response()->json(['success'=>false, 'error'=>$e->getMessage()])->setStatusCode(204);
        }
    }
}
