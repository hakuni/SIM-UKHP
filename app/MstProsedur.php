<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstProsedur extends Model
{
    //
    protected $guarded = ['idProsedur'];
    protected $table = 'mst_prosedurs';
    public $primaryKey = 'idProsedur';
    public $foreignKey = 'idPenelitian';

    public function penelitian(){
        return $this->belongsTo('App\MstPenelitian', 'idPenelitian', 'idPenelitian');
    }

    public function alatBahan(){
        return $this->hasOne('App\MstAlatBahan', 'idAlatBahan', 'idAlatBahan');
    }
}
