<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Patients extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            $patients = Patient::with('Employee')->orderBy('id', 'asc')->get();
            if(count($patients) > 0){
              return response()->json([
                  'message' => 'Patients was found',
                  'data' => $patients,
                  'code' => 200
              ]);
            }else{
              return response()->json([
                  'message' => 'Data was not found',
                  'code' => 201
              ]);
            }

        } else {
            return $this->show($id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $patient = new Patient;

        $patient->mabenhnhan = 'BN'.date("Ymdhis");
        $patient->hoten = $request->input('hoten');
        $patient->gioitinh = $request->input('gioitinh');
        $patient->cannang = $request->input('cannang');
        $patient->ngaysinh = $request->input('ngaysinh');
        $patient->diachi = $request->input('diachi');
        $patient->sodienthoai = $request->input('sodienthoai');
        $patient->tiencan = $request->input('tiencan');
        $patient->employee_id = $request->input('employee_id');

        $patient->save();

        if($patient !== NULL){
          return response()->json([
              'message' => 'Patient was created',
              'data' => $patient,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create Patient',
              'code' => 201
          ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $patient = Patient::find($id);
        if($patient !== NULL){
          return response()->json([
              'message' => 'Patient was found',
              'data' => $patient,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Patient was not found',
              'code' => 201
          ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $patient = Patient::find($id);

        $patient->mabenhnhan = $request->input('mabenhnhan');
        $patient->hoten = $request->input('hoten');
        $patient->gioitinh = $request->input('gioitinh');
        $patient->cannang = $request->input('cannang');
        $patient->ngaysinh = $request->input('ngaysinh');
        $patient->diachi = $request->input('diachi');
        $patient->sodienthoai = $request->input('sodienthoai');
        $patient->tiencan = $request->input('tiencan');
        $patient->employee_id = $request->input('employee_id');
        $patient->save();

        return response()->json([
            'message' => 'Patient was updated.',
            'data' => $patient,
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $patient = Patient::find($id);
        //print_r($employee);
        $patient->delete();
        //
        return response()->json([
            'message' => 'Patient deleted success.',
            'code' => 200
        ]);
    }
}
