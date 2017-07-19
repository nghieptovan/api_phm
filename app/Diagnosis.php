<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    //
    protected $fillable = array('id', 'ma_chuandoan', 'chuandoan','vt_chuandoan');
}
