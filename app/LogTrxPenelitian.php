<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTrxPenelitian extends Model
{
    //
    protected $guarded = ['idTrxLog'];
    protected $table = 'log_trx_penelitians';
    public $primaryKey = 'idTrxLog';
    public $timestamps = false;

    public function penelitian(){
        return $this->belongsTo('App\MstPenelitian', 'idPenelitian', 'idPenelitian');
    }
}
