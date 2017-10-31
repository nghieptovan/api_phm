<?php
namespace App\Http\Controllers;

use App\Medicine;
use App\ExportMedicine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExportMedicines extends Controller {

	public function store(Request $request) {
        $exportMedicine = new ExportMedicine;        

        $exportMedicine->medicine_id = $request->input('medicine_id');
        $exportMedicine->amount = $request->input('amount');
        $exportMedicine->exportedprice = $request->input('exportedprice');
        $exportMedicine->exporteddatetime = date("d/m/Y h:i:s");

        $exportMedicine->save();

        $medicine = Medicine::find($request->input('medicine_id'));
       	$medicine->amount -= $exportMedicine->amount;
       	$medicine->save(); 

        if($exportMedicine !== NULL){
          return response()->json([
              'message' => 'ExportMedicine was created',
              'data' => $exportMedicine,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create medicine',
              'code' => 201
          ]);
        }
    }

    public function getExported(Request $request) {
        $fromDate = date($request->input('fromDate'));
        $toDate = date($request->input('toDate'));
        $exported = ExportMedicine::whereBetween('created_at',  [$fromDate, $toDate])->groupBy('medicine_id')
->selectRaw('sum(amount) as total_export , medicine_id')
->get();
        if(count($exported) > 0){
        	foreach ($exported as $key => $value) {
        		$medicine = Medicine::with('TypeMedicine', 'BehaviourMedicine', 'Unit', 'Drug', 'PatentMedicine')->find($value['medicine_id']);

        		$exported[$key]['medicine'] = $medicine;
        	}
        	return response()->json([
              'message' => 'ExportMedicine was found',
              'data' => $exported,
              'code' => 200
          	]);

        }else{
        	return response()->json([
              'message' => 'ExportMedicine could not found',
              'data' => 'true',
              'code' => 200
          	]);
        }
    }

    public function destroy($id) {
        $exported = ExportMedicine::find($id);
        $medicine = Medicine::find($exported['medicine_id']);
        $medicine->amount += $exported['amount'];
        $medicine->save(); 

        $exported->delete();
        
        return response()->json([
            'message' => 'ExportMedicine deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
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
    

}
