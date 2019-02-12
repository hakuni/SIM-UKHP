<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstProsedur extends Model
{
    //
    protected $guarded = ['idProsedur'];
    protected $table = 'mst_prosedurs';
    protected $primaryKey = 'idProsedur';
}
