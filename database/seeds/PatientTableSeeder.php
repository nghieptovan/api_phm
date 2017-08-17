<?php

use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('patient')->insert([
            'mabenhnhan' => 'BN20170816103422',
            'hoten' => 'Lê Văn B',
            'gioitinh' => '1',
            'cannang' => '65',
            'ngaysinh' => '1998-08-16 10:16:01',
            'diachi' => '1 CMT8',
            'sodienthoai' => '0909xxxxx',
            'tiencan' => 'Không có tiền căn',
            'employee_id' => '1',
            'status_id' => '1',
        ]);
        DB::table('patient')->insert([
            'mabenhnhan' => 'BN2017081615522',
            'hoten' => 'Trần Văn',
            'gioitinh' => '2',
            'cannang' => '70',
            'ngaysinh' => '2000-08-16 10:16:01',
            'diachi' => 'Quang trung',
            'sodienthoai' => '0122321254',
            'tiencan' => 'Nhức đầu',
            'employee_id' => '1',
            'status_id' => '1',
        ]);
    }
}
