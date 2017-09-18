<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\Medicine;
use App\PrescriptionDetail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Prescriptions extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            $prescriptions = Prescription::with('Detail')->orderBy('id', 'asc')->get();
            $prescriptionDetail = [];
            foreach ($prescriptions->toArray() as $key => $value) {
              array_push($prescriptionDetail, $this->getMedicine($value['id']));
            }
            if(count($prescriptionDetail) > 0){
              return response()->json([
                  'message' => 'Prescriptions was found',
                  'data' => $prescriptionDetail,
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

        $checkPrescription = Prescription::where('name', $request->input('name'))->take(1)->get();
        if(count($checkPrescription) > 0){
          return response()->json([
              'message' => 'Prescription was exist',
              'data' => 'true',
              'code' => 201
          ]);

        }else{
          $prescription = new Prescription;
          $prescription->name = $request->input('name');
          $prescription->code = $request->input('code');                  
          $prescription->save();

          if($prescription !== NULL){
            
            return response()->json([
                'message' => 'Prescription was created',
                'data' => $prescription,
                'code' => 200
            ]);
          }else{
            return response()->json([
                'message' => 'Could not create prescription',
                'data' => 'true',
                'code' => 201
            ]);
          }
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getMedicine($id){
      $prescription = Prescription::with('Detail')->find($id);
      $detailmedicine = $prescription->toArray();
      $medicines = [];
      foreach ($detailmedicine['detail'] as $key => $value) {
        $detail = [];
        $medicine = Medicine::find($value['medicine_id'])->toArray();

        $detail['daydrink'] = $value['daydrink'];
        $detail['timesperday'] = $value['timesperday'];
        $detail['daycount'] = $value['daycount'];
        $detail['number'] = $value['number'];
        $detail['description'] = $medicine['description'];
        $detail['display_name'] = $medicine['display_name'];       
        $detail['medicine_id'] = $medicine['id'];
        array_push($medicines, $detail);
        # code...
      }
      $detailmedicine['detail'] = $medicines;
      return $detailmedicine;
    }


    public function show($id) {
        $detailPrescription = $this->getMedicine($id);        
        if($detailPrescription !== NULL){
          return response()->json([
              'message' => 'Prescription was found',
              'data' => $detailPrescription,
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
    public function update(Request $request, $id) {
        $prescription = Prescription::find($id);
        if(isset($request->name))
          $prescription->name = $request->input('name');

        if(isset($request->code))
          $prescription->code = $request->input('code');
        
        $prescription->save();
        return response()->json([
            'message' => 'prescription was updated.',
            'data' => $prescription,
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
        $prescription = Prescription::find($id);
        $prescription->delete();
        //
        return response()->json([
            'message' => 'Prescription deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }
}
