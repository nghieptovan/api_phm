<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    //
    protected $table='prescriptiondetail';

	public function Prescription()
	{
	    return $this->belongsTo('App\Prescription', 'prescription_id');
	}
}
