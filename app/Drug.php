<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    //
    protected $table='drug';

    public function Medicine()
    {
        return $this->hasOne('App\Medicine', 'id');
    }
}
