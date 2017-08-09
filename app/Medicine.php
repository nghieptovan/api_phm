<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
    protected $fillable = array('id', 'mathuoc', 'tenthuoc','tenthuoc_toa','quicachsudung','phanloai','soluong','dongia','nhandang','ngaynhap');
}
