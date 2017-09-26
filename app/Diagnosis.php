<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    //
    protected $table='diagnosis';

     public function BillDetail()
    {
        return $this->hasOne('App\Bill', 'id');
    }
}
