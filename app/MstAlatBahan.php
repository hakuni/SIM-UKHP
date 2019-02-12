<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstAlatBahan extends Model
{
    //
    protected $guarded = ['idAlatBahan'];
    protected $table = 'mst_alat_bahans';
    public $primaryKey = 'idAlatBahan';
}
