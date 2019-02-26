<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstDataClient extends Model
{
    //
    protected $guarded = ['idDataClient'];
    protected $table = 'mst_data_clients';
    public $primaryKey = 'idDataClient';
    public $timestamps = false;

    public function penelitian(){
        return $this->hasOne('App\MstPenelitian', 'idDataClient', 'idDataClient');
    }
}
