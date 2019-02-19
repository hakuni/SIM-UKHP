<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxPenelitian extends Model
{
    //
    protected $guarded = ['idTrxPenelitian'];
    protected $table = 'trx_penelitians';
    public $primaryKey = 'idTrxPenelitian';
}
