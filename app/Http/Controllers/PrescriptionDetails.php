<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\PrescriptionDetail;
use App\Medicine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PrescriptionDetails extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            $prescriptions = PrescriptionDetail::orderBy('id', 'asc')->get();
            foreach ($prescriptions as $key => $value) {
              # code...
              $medicines = Medicine::with('TypeMedicine', 'BehaviourMedicine', 'Unit', 'Drug', 'PatentMedicine')->find($value->medicine_id);
              if(count($medicines) == 1){
                $prescriptions[$key]['medicine'] = $medicines;
              }
            }
            
            if(count($prescriptions) > 0){
              return response()->json([
                  'message' => 'PrescriptionDetails was found.',
                  'data' => $prescriptions,
                  'code' => 200
              ]);
            }else{
              return response()->json([
                  'message' => 'Data was not found',
                  'data' => 'true',
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
        $prescription_id = $request->input('prescription_id');
        if($prescription_id !== null){
          $prescription = Prescription::find($prescription_id);
          $prescription_detail = $request->input('prescription_detail');
          if(count($prescription_detail) > 0){
            $returnList = [];
            foreach ($prescription_detail as $key => $value) {
              # code...
              $prescription_det = new PrescriptionDetail;
              $prescription_det->prescription_id = $value['prescription_id'];
              $prescription_det->medicine_id = $value['medicine_id'];
              $prescription_det->daydrink = $value['daydrink'];
              $prescription_det->timesperday = $value['timesperday'];
              $prescription_det->daycount = $value['daycount'];
              $prescription_det->number = $value['number'];
              $prescription_det->save();
              array_push($returnList, $prescription_det);
            }

            return response()->json([
              'message' => 'PrescriptionDetail was created.',
              'data' => $returnList,
              'code' => 200
          ]);
          }
        }else{
          return response()->json([
              'message' => 'prescription_id could not be null',
              'data' => 'true',
              'code' => 201
          ]);
        }
    }

    public function getPrescriptionDetail($prescription_id) {
        if ($prescription_id !== null) {
            $prescriptions = PrescriptionDetail::where('prescription_id', $prescription_id)->get();

            foreach ($prescriptions as $key => $value) {
              # code...
              $medicines = Medicine::with('TypeMedicine', 'BehaviourMedicine', 'Unit', 'Drug', 'PatentMedicine')->find($value->medicine_id);
              if(count($medicines) == 1){
                $prescriptions[$key]['medicine'] = $medicines;
              }
            }

            if(count($prescriptions) > 0){
              return response()->json([
                  'message' => 'PrescriptionDetails was found',
                  'data' => $prescriptions,
                  'code' => 200
              ]);
            }else{
              return response()->json([
                  'message' => 'Data was not found',
                  'data' => 'true',
                  'code' => 201
              ]);
            }

        } else {
            return response()->json([
              'message' => 'prescription_id could not be null',
              'data' => 'true',
              'code' => 201
          ]);
        }
    }
    

    public function savePrescriptionDetail(Request $request) {        
        $prescription_id = $request->input('prescription_id');
        if($prescription_id !== null){
          $prescription = Prescription::find($prescription_id);
          $prescription_detail = $request->input('prescription_detail');
          if(count($prescription_detail) > 0){

            $listPatient = PrescriptionDetail::where('prescription_id', $prescription_id)->delete();

            $returnList = [];
            foreach ($prescription_detail as $key => $value) {
              # code...
              $prescription_det = new PrescriptionDetail;
              $prescription_det->prescription_id = $value['prescription_id'];
              $prescription_det->medicine_id = $value['medicine_id'];
              $prescription_det->daydrink = $value['daydrink'];
              $prescription_det->timesperday = $value['timesperday'];
              $prescription_det->daycount = $value['daycount'];
              $prescription_det->number = $value['number'];
              $prescription_det->save();
              array_push($returnList, $prescription_det);
            }
            return response()->json([
              'message' => 'PrescriptionDetail was created.',
              'data' => $returnList,
              'code' => 200
          ]);
          }
        }else{
          return response()->json([
              'message' => 'prescription_id could not be null',
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
        $prescription = PrescriptionDetail::find($id);

        $medicines = Medicine::with('TypeMedicine', 'BehaviourMedicine', 'Unit', 'Drug', 'PatentMedicine')->find($prescription->medicine_id);
              if(count($medicines) == 1){
                $prescription['medicine'] = $medicines;
              }
        if($prescription !== NULL){
          return response()->json([
              'message' => 'PrescriptionDetail was found',
              'data' => $prescription,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Prescription was not found',
              'data' => 'true',
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
    // public function update(Request $request, $id) {
    //     $prescription = PrescriptionDetail::find($id);
    //     if(isset($request->name))
    //       $prescription->name = $request->input('name');

    //     if(isset($request->code))
    //       $prescription->code = $request->input('code');
        
    //     $prescription->save();
    //     return response()->json([
    //         'message' => 'prescription was updated.',
    //         'data' => $prescription,
    //         'code' => 200
    //     ]);
    // }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $prescription = PrescriptionDetail::find($id);
        $prescription->delete();
        //
        return response()->json([
            'message' => 'PrescriptionDetail deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }
}
