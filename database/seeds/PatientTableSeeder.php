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
            'code' => 'BN20170816103422',
            'name' => 'Lê Văn B',
            'sex' => '1',
            'weight' => '65',
            'birthday' => '16/07/1990 10:16:01',
            'address' => '1 CMT8',
            'phone' => '0909xxxxx',
            'diagnosis' => 'Không có tiền căn',
            'employee_id' => '1',
            'status_id' => '1',
        ]);
        DB::table('patient')->insert([
            'code' => 'BN2017081615522',
            'name' => 'Trần Văn',
            'sex' => '2',
            'weight' => '70',
            'birthday' => '02/07/1995 12:16:01',
            'address' => 'Quang trung',
            'phone' => '0122321254',
            'diagnosis' => 'Nhức đầu',
            'employee_id' => '1',
            'status_id' => '1',
        ]);
    }
}
