<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
    protected $table='medicines';
    protected $fillable = array('id', 'mathuoc', 'tenthuoc','tenthuoc_toa','quicachsudung','phanloai','soluong','dongia','nhandang','ngaynhap');

    public function phanloai(){
        return $this->belongsTo('App\TypeMedicine', 'typemedicine_id');
    }

    public function quycachsudung(){
        return $this->belongsTo('App\UsingMedicine', 'usingmedicine_id');
    }
}
