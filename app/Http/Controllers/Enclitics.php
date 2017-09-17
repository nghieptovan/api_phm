<?php

namespace App\Http\Controllers;

use App\Enclitic;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\DB;


class Enclitics extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    

    public function getList(Request $request) {
    	// $checkList = Enclitic::where('status_id', $request->input('status_id'))->get();
    	// $checkList = Enclitic::whereRaw('date like %'.$request->input('date').'% and status_id = '.$request->input('status_id'))->get();
    	$checkList = Enclitic::where('status_id', $request->input('status_id'))
    ->Where('date', 'like', $request->input('date') . '%')->get();

        if(count($checkList) > 0){

          return response()->json([
              'message' => 'Enclitics was found',
              'data' => $checkList,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Data was not found',
              'code' => 201
          ]);
        }          
    }
    public function index($id = null) {
        if ($id == null) {
            $patients = Patient::with('Employee', 'Trangthai')->orderBy('id', 'asc')->get();
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

        $patient->code = 'BN'.date("Ymdhis");
        $patient->name = $request->input('name');
        $patient->sex = $request->input('sex');
        $patient->weight = $request->input('weight');
        $patient->birthday = $request->input('birthday');
        $patient->address = $request->input('address');
        $patient->phone = $request->input('phone');
        $patient->diagnosis = $request->input('diagnosis');
        $patient->employee_id = $request->input('employee_id');
        $patient->status_id = 1;

        $patient->save();

        if($patient !== NULL){
          $enclitic = new Enclitic;

          $enclitic->patient_id = $patient->id;
          $enclitic->status_id = 1;
          $enclitic->employee_id = $patient->employee_id;
          $enclitic->date = date("d/m/Y h:i:s");

          $enclitic->save();

          $patient->enclitic = $enclitic;

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
    public function getByStatus(Request $request){
      print_r($request->status);
      
      // $patient = Patient::find($status);
      //   if($patient !== NULL){
      //     return response()->json([
      //         'message' => 'Patient was found',
      //         'data' => $patient,
      //         'code' => 200
      //     ]);
      //   }else{
      //     return response()->json([
      //         'message' => 'Patient was not found',
      //         'code' => 201
      //     ]);
      //   }
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

        if(isset($request->name))
          $patient->name = $request->input('name');
        if(isset($request->sex))
          $patient->sex = $request->input('sex');
        if(isset($request->weight))
          $patient->weight = $request->input('weight');
        if(isset($request->birthday))
          $patient->birthday = $request->input('birthday');
        if(isset($request->address))
          $patient->address = $request->input('address');
        if(isset($request->phone))
          $patient->phone = $request->input('phone');
        if(isset($request->diagnosis))
          $patient->diagnosis = $request->input('diagnosis');
        if(isset($request->employee_id))
          $patient->employee_id = $request->input('employee_id');
        if(isset($request->status_id))
          $patient->status_id = $request->input('status_id');
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
