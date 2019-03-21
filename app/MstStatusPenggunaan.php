<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstStatusPenggunaan extends Model
{
    //
    protected $guarded = ['idStatusPenggunaan'];
    protected $table = 'mst_status_penggunaans';
    protected $primaryKey = 'idStatusPenggunaan';

    public function logPemakaian(){
        return $this->hasMany('App\LogPemakaian', 'idStatusPenggunaan', 'idStatusPenggunaan');
    }
}
