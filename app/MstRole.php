<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstRole extends Model
{
    //
    protected $guarded = ['idRole'];
    protected $table = 'mst_roles';
    protected $primaryKey = 'idRole';

    public function user(){
        return $this->hasMany('App\User', 'idRole', 'idRole');
    }
}
