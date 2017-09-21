<?php

namespace App\Http\Controllers;

use App\Enclitic;
use App\Patient;
use App\Employee;
use App\Bill;
use App\BillDetail;
use App\Medicine;
use App\ExportMedicine;
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
    	$checkList = Enclitic::where('status_id', $request->input('status_id'))
    ->Where('date', 'like', $request->input('date') . '%')->get();

        if(count($checkList) > 0){
          foreach ($checkList as $key => $value) {
            $employee = Employee::find($value['employee_id']);
            $patient = Patient::find($value['patient_id']);
            $checkList[$key]['employee'] = $employee ? $employee : [];
            $checkList[$key]['patient'] = $patient ? $patient : [];
          }
          return response()->json([
              'message' => 'Enclitics was found',
              'data' => $checkList,
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
    
    public function index($id = null) {
        if ($id == null) {
            $enclitics = Enclitic::orderBy('id', 'asc')->get();
            if(count($enclitics) > 0){

              return response()->json([
                  'message' => 'Enclitices was found',
                  'data' => $enclitics,
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

    public function takeMedicine(Request $request, $id){
        if(isset($request->dispenser_id)){
            $dispenser_id = $request->input('dispenser_id');
        }
        
        $enclitic = Enclitic::find($id);
        
        if($enclitic != null){
            $bill = Bill::where('enclitic_id', $enclitic->id)->firstOrFail();
            $bill->dispenser_id = $dispenser_id;
            $bill->dispensedatetime = date("d/m/Y h:i:s");
            $bill->save();
    
            $billDetails = BillDetail::where('bill_id', $bill->id)->get();
            foreach ($billDetails as $key => $value) {  
                
                $totalDrug = $value->timesperday * $value->daycount;
    
                // echo $value->medicine_id.'----'.$totalDrug;
                $medicine = Medicine::find($value->medicine_id);
                $medicine->amount -= $totalDrug;
                $priceDrug = $medicine->sellprice;
                $medicine->save();
    
                $exportMedicine = new ExportMedicine;  
                $exportMedicine->medicine_id = $value->medicine_id;
                $exportMedicine->amount = $totalDrug;
                $exportMedicine->exportedprice = $priceDrug;
                $exportMedicine->exporteddatetime = date("d/m/Y h:i:s");    
                $exportMedicine->save();
    
            }

            if($enclitic->status_id == 3){
            $enclitic->status_id = 4;
            $enclitic->save();
            return response()->json([
                'message' => 'Enclitic was updated.',
                'data' => $enclitic,
                'code' => 200
            ]);
            }
            
        }else{
            return response()->json([
                'message' => 'Enclitic was not found.',
                'data' => 'true',
                'code' => 201
            ]);
        }

    }

    public function store(Request $request) {
        $enclitic = new Enclitic;

        $enclitic->patient_id = $request->input('patient_id');
        $enclitic->status_id = $request->input('status_id');;
        $enclitic->employee_id = $request->input('employee_id');

        if($request->input('date') !== null){
          $enclitic->date = $request->input('date');
        }
        else{
          $enclitic->date = date("d/m/Y h:i:s");
        }

        $enclitic->save();

        return response()->json([
            'message' => 'Enclitic was created',
            'data' => $enclitic,
            'code' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $enclitic = Enclitic::find($id);
        if($enclitic !== NULL){
          return response()->json([
              'message' => 'Enclitic was found',
              'data' => $enclitic,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Enclitic was not found',
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
        $enclitic = Enclitic::find($id);

        if(isset($request->patient_id))
          $enclitic->patient_id = $request->input('patient_id');
        if(isset($request->status_id))
          $enclitic->status_id = $request->input('status_id');
        if(isset($request->employee_id))
          $enclitic->employee_id = $request->input('employee_id');
        $enclitic->date = date("d/m/Y h:i:s");
        
        $enclitic->save();

        return response()->json([
            'message' => 'Enclitic was updated.',
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
        $enclitic = Enclitic::find($id);
        $enclitic->delete();
        //
        return response()->json([
            'message' => 'Enclitic deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }
}
