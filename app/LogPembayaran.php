<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogPembayaran extends Model
{
    //
    protected $guarded = ['idLogPembayaran'];
    protected $table = 'log_pembayarans';
    public $primaryKey = 'idLogPembayaran';
}
