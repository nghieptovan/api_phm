<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table='role';
    protected $fillable = array('role_id', 'role_name');
    protected $hidden = array('id','created_at', 'updated_at' );
     public function Employee()
     {
         return $this->hasMany('App\Employee', 'role_id');
     }
}
