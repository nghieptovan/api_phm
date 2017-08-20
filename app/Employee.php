<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table='employees';
    protected $fillable = array('id', 'username', 'password', 'role_id', 'stringlogin', 'fullname', 'image');
    //protected $hidden = array('password');

    public function Role(){
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function Patient()
    {
        return $this->hasMany('App\Patient', 'employee_id');
    }


}
