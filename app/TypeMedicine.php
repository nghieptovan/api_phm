<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeMedicine extends Model
{
    //
    protected $table = 'typemedicine';
    public function Medicine()
    {
        return $this->hasOne('App\Medicine', 'id');
    }
}
