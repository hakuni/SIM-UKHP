<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstPenelitian extends Model
{
    //
    protected $guarded = ['idPenelitian'];
    protected $table = 'mst_penelitians';
    public $primaryKey = 'idPenelitian';

    public function prosedur(){
        return $this->hasOne('App\MstProsedur', 'idPenelitian', 'idPenelitian');
    }

    public function dataClient(){
        return $this->belongsTo('App\MstDataClient', 'idDataClient', 'idDataClient');
    }
}
