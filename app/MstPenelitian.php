<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstPenelitian extends Model
{
    //
    protected $guarded = ['idPenelitian'];
    protected $table = 'mst_penelitians';
    public $primaryKey = 'idPenelitian';

    public function prosedur(){
        return $this->hasOne('App\MstProsedur', 'idPenelitian', 'idPenelitian');
    }

    public function dataClient(){
        return $this->belongsTo('App\MstDataClient', 'idDataClient', 'idDataClient');
    }

    public function kategori(){
        return $this->belongsTo('App\MstKategori', 'idKategori', 'idKategori');
    }

    public function logPembayaran(){
        return $this->hasMany('App\LogPembayaran', 'idPenelitian', 'idPenelitian');
    }

    public function logTrxPenelitian(){
        return $this->hasMany('App\LogTrxPenelitian', 'idPenelitian', 'idPenelitian');
    }

    public function milestone(){
        return $this->belongsTo('App\MstMilestone', 'lastMilestoneID', 'idMilestone');
    }

    public function statusPenelitian(){
        return $this->belongsTo('App\MstStatusPenelitian', 'statusPenelitian', 'idStatusPenelitian');
    }

    public function rincianBiaya(){
        return $this->hasMany('App\RincianBiaya', 'idPenelitian', 'idPenelitian');
    }

    public function trxPenelitian(){
        return $this->hasMany('App\TrxPenelitian', 'idPenelitian', 'idPenelitian');
    }
}
