<?php
namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Medicines extends Controller {

    public function index($id = null) {
        if ($id == null) {
            $medicines = Medicine::with('TypeMedicine', 'BehaviourMedicine')->orderBy('id', 'asc')->get();
            if(count($medicines) > 0){
              return response()->json([
                  'message' => 'Medicines was found',
                  'data' => $medicines,
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

    public function show($id) {
        $medicines = Medicine::with('TypeMedicine', 'BehaviourMedicine')->find($id);
        if($medicines !== NULL){
          return response()->json([
              'message' => 'Medicine was found',
              'data' => $medicines,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Medicine was not found',
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
        $medicine = new Medicine;
        $medicine->code = $request->input('code');

        $medicine->name = $request->input('name');

        $medicine->display_name = $request->input('display_name');

        $medicine->description = $request->input('description');

        $medicine->amount = $request->input('amount');

        $medicine->typemedicine_id = $request->input('typemedicine_id');

        $medicine->behaviourmedicine_id = $request->input('behaviourmedicine_id');

        $medicine->drug_id = $request->input('drug_id');

        $medicine->patentmedicine_id = $request->input('patentmedicine_id');

        $medicine->unit_id = $request->input('unit_id');

        $medicine->sellprice = $request->input('sellprice');

        $medicine->importedprice = $request->input('importedprice');

        $medicine->save();

        if($medicine !== NULL){
          return response()->json([
              'message' => 'Medicine was created',
              'data' => $medicine,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create medicine',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $medicine = Medicine::find($id);
        if(isset($request->code))
          $medicine->code = $request->input('code');

        if(isset($request->name))
          $medicine->name = $request->input('name');

        if(isset($request->display_name))
          $medicine->display_name = $request->input('display_name');

        if(isset($request->description))
          $medicine->description = $request->input('description');

        if(isset($request->amount))
          $medicine->amount = $request->input('amount');

        if(isset($request->typemedicine_id))
          $medicine->typemedicine_id = $request->input('typemedicine_id');

        if(isset($request->behaviourmedicine_id))
          $medicine->behaviourmedicine_id = $request->input('behaviourmedicine_id');

        if(isset($request->drug_id))
          $medicine->drug_id = $request->input('drug_id');

        if(isset($request->patentmedicine_id))
          $medicine->patentmedicine_id = $request->input('patentmedicine_id');

        if(isset($request->unit_id))
          $medicine->unit_id = $request->input('unit_id');

        if(isset($request->sellprice))
          $medicine->sellprice = $request->input('sellprice');

        if(isset($request->importedprice))
          $medicine->importedprice = $request->input('importedprice');

        $medicine->save();
        return response()->json([
            'message' => 'Medicine was updated.',
            'data' => $medicine,
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
        $medicine = Medicine::find($id);
        $medicine->delete();
        //
        return response()->json([
            'message' => 'Medicine deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }

}
