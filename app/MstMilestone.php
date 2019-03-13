<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstMilestone extends Model
{
    //
    protected $guarded = ['idMilestone'];
    protected $table = 'mst_milestones';
    public $primaryKey = 'idMilestone';

    public function trxPenelitian(){
        return $this->hasMany('App\TrxPenelitian', 'idMilestone', 'idMilestone');
    }

    public function penelitian(){
        return $this->hasMany('App\MstPenelitian', 'idPenelitian', 'idPenelitian');
    }
}
