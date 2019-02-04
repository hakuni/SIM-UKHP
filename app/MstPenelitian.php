<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstPenelitian extends Model
{
    //
    protected $guarded = ['idPenelitian'];
    protected $table = 'mst_penelitians';
    public $primaryKey = 'idPenelitian';
}
