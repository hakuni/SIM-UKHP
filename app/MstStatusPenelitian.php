<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstStatusPenelitian extends Model
{
    //
    protected $guarded = ['idStatusPenelitian'];
    protected $table = 'status_penelitians';
    protected $primaryKey = 'idStatusPenelitian';

    public function penelitian(){
        return $this->hasMany('App\MstPenelitian', 'idPenelitian', 'idPenelitian');
    }
}
