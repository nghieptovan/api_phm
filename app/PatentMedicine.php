<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatentMedicine extends Model
{
    //
    protected $table='patentmedicine';

    public function Medicine()
    {
        return $this->hasOne('App\Medicine', 'id');
    }
}
