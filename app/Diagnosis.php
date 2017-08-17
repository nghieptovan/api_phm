<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    //
    protected $table='diagnosis';
    protected $fillable = array('id', 'ma_chuandoan', 'chuandoan','vt_chuandoan');
}
