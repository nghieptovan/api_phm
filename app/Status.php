<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $table='status';
    protected $fillable = array('status_id', 'status_name');
    protected $hidden = array('created_at', 'updated_at');
    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }
}
