<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table='employees';
    protected $fillable = array('id', 'username', 'position', 'madangnhap', 'fullname', 'image');


    public function Role(){
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function Patient()
    {
        return $this->hasMany('App\Patient', 'id');
    }


}
