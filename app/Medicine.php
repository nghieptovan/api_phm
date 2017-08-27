<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //
    protected $table='medicines';

    public function TypeMedicine(){
        return $this->belongsTo('App\TypeMedicine', 'typemedicine_id');
    }

    public function BehaviourMedicine(){
        return $this->belongsTo('App\BehaviourMedicine', 'behaviourmedicine_id');
    }
}
