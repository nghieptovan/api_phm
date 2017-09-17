<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $table='patient';
    protected $fillable = array('id', 'mabenhnhan', 'hoten','gioitinh','cannang','ngaysinh',
    'diachi','sodienthoai','tiencan','ngaytao','ngaysua','status_id');

    public function Employee(){
        return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function Trangthai(){
        return $this->belongsTo('App\Status', 'status_id');
    }

}
