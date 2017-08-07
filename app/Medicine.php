<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
    protected $fillable = array('id', 'username', 'password','position','madangnhap','fullname','image');
}
