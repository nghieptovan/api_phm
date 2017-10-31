<?php
namespace App\Http\Controllers;

use App\Medicine;
use App\ImportMedicine;
use App\ExportMedicine;
use App\Drug;
use App\PatentMedicine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Medicines extends Controller {

    public function index($id = null) {
        if ($id == null) {
            $medicines = Medicine::with('TypeMedicine', 'BehaviourMedicine', 'Unit', 'Drug', 'PatentMedicine')->orderBy('id', 'asc')->get();
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

    public function getReport(Request $request) {
        $fromDate = date($request->input('fromDate'));
        $toDate = date($request->input('toDate'));
        

        $imported = ImportMedicine::whereBetween('created_at',  [$fromDate, $toDate])->groupBy('medicine_id')
->selectRaw('sum(amount) as total_import , medicine_id')
->get();
        if(count($imported) > 0){
          foreach ($imported as $key => $value) {
            $medicine = Medicine::find($value['medicine_id']);

            $imported[$key]['medicine'] = $medicine;
          }
          $dataReport['imported'] = [
              'message' => 'ImportMedicines was found',
              'data' => $imported
          ];

        }

        $exported = ExportMedicine::whereBetween('created_at',  [$fromDate, $toDate])->groupBy('medicine_id')
->selectRaw('sum(amount) as total_export , medicine_id')
->get();

        if(count($exported) > 0){
          foreach ($exported as $key => $value) {
            $medicine = Medicine::find($value['medicine_id']);

            $exported[$key]['medicine'] = $medicine;
          }
          $dataReport['exported'] = [
              'message' => 'ExportMedicines was found',
              'data' => $exported
          ];

        }
        
        return response()->json([
              'message' => 'Reportmedicine',
              'data' => $dataReport,
              'code' => 200
        ]);  
    }

    public function show($id) {
        $medicines = Medicine::with('TypeMedicine', 'BehaviourMedicine', 'Unit', 'Drug', 'PatentMedicine')->find($id);
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
        $medicine->code = date("d/m/Y-h:i:s");

        $medicine->name = $request->input('name');

        $medicine->display_name = $request->input('display_name');

        $medicine->description = $request->input('description');

        $medicine->amount = $request->input('amount');

        $medicine->typemedicine_id = $request->input('typemedicine_id');

        $medicine->behaviourmedicine_id = $request->input('behaviourmedicine_id');

        if(isset($request->drug_name) && isset($request->drug_code)){
          $drug = new Drug;
          $drug->name = $request->input('drug_name');
          $drug->code = $request->input('drug_code');
          $drug->save();

          $medicine->drug_id = $drug->id;
        }else{
          if(isset($request->drug_id)){
            $medicine->drug_id = $request->input('drug_id');
          }
        }

        if(isset($request->patent_name) && isset($request->patent_code)){
          $patentMedicine = new PatentMedicine;
          $patentMedicine->name = $request->input('patent_name');
          $patentMedicine->code = $request->input('patent_code');
          $patentMedicine->save();

          $medicine->patentmedicine_id = $patentMedicine->id;

        }else{
          if(isset($request->patentmedicine_id)){
            $medicine->patentmedicine_id = $request->input('patentmedicine_id');
          }
        }      

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
          $medicine->code = date("d/m/Y-h:i:s");

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
