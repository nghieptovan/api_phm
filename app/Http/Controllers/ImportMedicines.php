<?php
namespace App\Http\Controllers;

use App\Medicine;
use App\ImportMedicine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImportMedicines extends Controller {

	public function store(Request $request) {
        $importMedicine = new ImportMedicine;        

        $importMedicine->medicine_id = $request->input('medicine_id');
        $importMedicine->amount = $request->input('amount');
        $importMedicine->importedprice = $request->input('importedprice');
        $importMedicine->importeddatetime = date("d/m/Y h:i:s");

        $importMedicine->save();

        $medicine = Medicine::find($request->input('medicine_id'));
       	$medicine->amount += $importMedicine->amount;
       	$medicine->save(); 

        if($importMedicine !== NULL){
          return response()->json([
              'message' => 'ImportMedicine was created',
              'data' => $importMedicine,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create medicine',
              'code' => 201
          ]);
        }
    }

    public function getImported(Request $request) {
        $fromDate = date($request->input('fromDate'));
        $toDate = date($request->input('toDate'));
        $imported = ImportMedicine::whereBetween('importeddatetime',  [$fromDate, $toDate])->get(); 
        if(count($imported) > 0){
        	foreach ($imported as $key => $value) {
        		$medicine = Medicine::find($value['medicine_id']);

        		$imported[$key]['medicine'] = $medicine;
        	}
        	return response()->json([
              'message' => 'ImportMedicines was found',
              'data' => $imported,
              'code' => 200
          	]);

        }else{
        	return response()->json([
              'message' => 'ImportMedicines could not found',
              'data' => 'true',
              'code' => 200
          	]);
        }
    }


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
