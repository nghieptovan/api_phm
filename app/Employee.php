<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = array('id', 'username', 'password','position','madangnhap','fullname','image');
}
