<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstStatusPenelitian extends Model
{
    //
    protected $guarded = ['idStatusPenelitian'];
    protected $table = 'status_penelitians';
    protected $primaryKey = 'idStatusPenelitian';
}
