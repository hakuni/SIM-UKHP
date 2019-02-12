<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstKategori extends Model
{
    //
    protected $guarded = ['idKategori'];
    protected $table = 'kategoris';
    protected $primaryKey = 'idKategori';

}
