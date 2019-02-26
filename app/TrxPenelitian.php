<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxPenelitian extends Model
{
    //
    protected $guarded = ['idTrxPenelitian'];
    protected $table = 'trx_penelitians';
    public $primaryKey = 'idTrxPenelitian';

    public function penelitian(){
        return $this->belongsTo('App\MstPenelitian', 'idPenelitian', 'idPenelitian');
    }

    public function milestone(){
        return $this->belongsTo('App\MstMilestone', 'idMilestone', 'idMilestone');
    }
}
