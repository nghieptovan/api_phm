<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BehaviourMedicine extends Model
{
    //
    protected $table = 'behaviourmedicine';
    public function Medicine()
    {
        return $this->hasOne('App\Medicine', id);
    }
}
