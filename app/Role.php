<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table='role';
    protected $fillable = array('name', 'code');
     public function Employee()
     {
         return $this->hasMany('App\Employee');
     }
}
