<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstMilestone extends Model
{
    //
    protected $guarded = ['idMilestone'];
    protected $table = 'mst_milestones';
    public $primaryKey = 'idMilestone';
}
