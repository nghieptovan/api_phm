<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Enclitic;
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

    public function searchPatient(Request $request) {
      if(isset($request->code)){
        $listPatient = Patient::where('code', 'like', '%'.$request->input('code').'%')->get();
      }
      if(isset($request->name)){
        $listPatient = Patient::where('name', 'like', '%'.$request->input('name').'%')->get();
      }
      if(isset($request->phone)){
        $listPatient = Patient::where('phone', 'like', '%'.$request->input('phone').'%')->get();
      }
    
      if(count($listPatient) > 0){
        return response()->json([
              'message' => 'Patients was found',
              'data' => $listPatient,
              'code' => 200
          ]);
      }else{
        return response()->json([
            'message' => 'Data was not found',
            'data' => 'true',
            'code' => 201
        ]);
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
              'data' => 'true',
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
          $listEnclitic = Enclitic::where('patient_id', $patient->id)->get();
          if(count($listEnclitic) > 0){
            $patient['listEnclitic'] = $listEnclitic;
          }else{
            $patient['listEnclitic'] = [];
          }
          return response()->json([
              'message' => 'Patient was found',
              'data' => $patient,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Patient was not found',
              'data' => 'true',
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
            'data' => 'true',
            'code' => 200
        ]);
    }
}
