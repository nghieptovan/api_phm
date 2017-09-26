<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    //
    protected $table = 'billdetail';

    public function Medicine(){
        return $this->belongsTo('App\Medicine', 'medicine_id');
    }
}
