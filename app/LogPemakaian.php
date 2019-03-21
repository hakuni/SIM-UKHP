<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogPemakaian extends Model
{
    //
    protected $guarded = ['idLogPemakaian'];
    protected $table = 'log_pemakaians';
    public $primaryKey = 'idLogPemakaian';

    public function statusPenggunaan(){
        return $this->belongsTo('App\MstStatusPenggunaan', 'idStatusPenggunaan', 'idStatusPenggunaan');
    }
}
