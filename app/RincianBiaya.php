<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RincianBiaya extends Model
{
    //
    protected $guarded = ['idRincianBiaya'];
    protected $table = 'rincian_biayas';
    public $primaryKey = 'idRincianBiaya';
}
