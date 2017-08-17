<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeMedicine extends Model
{
    //
    protected $table='typemedicine';
    protected $hidden = array('created_at', 'updated_at');
    public function Medicine()
    {
        return $this->hasOne('App\Medicine', 'phanloai');
    }
}
