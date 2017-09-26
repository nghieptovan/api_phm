<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $table='bill';

    public function Diagnosis(){
        return $this->belongsTo('App\Diagnosis', 'diagnosis_id');
    }
}
