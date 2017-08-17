<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsingMedicine extends Model
{
    //
    protected $table='usingmedicine';
    protected $hidden = array('created_at', 'updated_at');
    public function Medicine()
    {
        return $this->hasOne('App\Medicine');
    }
}
