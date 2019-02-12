<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogPembelian extends Model
{
    //
    protected $guarded = ['idLogPembelian'];
    protected $table = 'log_pembelians';
    public $primaryKey = 'idLogPembelian';
}
