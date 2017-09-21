<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Patient;
use App\Employee;
use App\Enclitic;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Bills extends Controller
{
    //
    public function index($id = null) {
        if ($id == null) {
            $bills = Bill::orderBy('id', 'asc')->get();
            if(count($bills) > 0){
            	$bill_details = [];
            	foreach ($bills as $key => $value) {
            		$doctor = $this->getEmployee($value['doctor_id']);
        			$patient = $this->getPatient($value['patient_id']);
            		$bill_detail = $this->getDetail($value['id']);
            		$bills[$key]['details'] = $bill_detail;
            		$bills[$key]['doctor'] = $doctor;
            		$bills[$key]['patient'] = $patient;
            	}
              return response()->json([
                  'message' => 'Bills was found',
                  'data' => $bills,
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

    public function getByPatient($patient_id) {
        if ($patient_id !== null) {
            $bills = Bill::where('patient_id', $patient_id)->get();
            if(count($bills) > 0){
              $bill_details = [];
              foreach ($bills as $key => $value) {
                $doctor = $this->getEmployee($value['doctor_id']);
              $patient = $this->getPatient($value['patient_id']);
                $bill_detail = $this->getDetail($value['id']);
                $bills[$key]['details'] = $bill_detail;
                $bills[$key]['doctor'] = $doctor;
                $bills[$key]['patient'] = $patient;
              }
              return response()->json([
                  'message' => 'Bills was found',
                  'data' => $bills,
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
                  'message' => 'Patient_id is not null',
                  'data' => 'true',
                  'code' => 201
              ]);
        }
    }

    public function show($id) {
        $bill = Bill::find($id);
        if($bill !== NULL){
        	$doctor = $this->getEmployee($bill->doctor_id);
        	$patient = $this->getPatient($bill->patient_id);
        	$bill_detail = $this->getDetail($id);

            $bill['details'] = $bill_detail;
            $bill['patient'] = $patient;
            $bill['doctor'] = $doctor;
          return response()->json([
              'message' => 'Bill was found',
              'data' => $bill,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Config was not found',
              'data' => 'true',
              'code' => 201
          ]);
        }
    }
    public function getEmployee($id){
    	$employee = Employee::find($id);
    	if(count($employee) > 0){
    		return $employee;
    	}else{
    		return [];
    	}
    }
    public function getPatient($id){
    	$patient = Patient::find($id);
    	if(count($patient) > 0){
    		return $patient;
    	}else{
    		return [];
    	}
    }
    public function getDetail($id){
    	$detail = BillDetail::where('bill_id', $id)->get();
    	if(count($detail) > 0){
    		return $detail;
    	}else{
    		return [];
    	}
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $bill = new Bill;
        $bill->patient_id = $request->input('patient_id');
        $bill->enclitic_id = $request->input('enclitic_id');        
        $bill->billdate = date("d/m/Y h:i:s");
        $bill->symptom = $request->input('symptom');
        $bill->diagnosis_id = $request->input('diagnosis_id');
        $bill->subdiagnosis = $request->input('subdiagnosis');
        $bill->introduction = $request->input('introduction');
        $bill->nextdate = $request->input('nextdate');
        $bill->index = $request->input('index');
        $bill->doctor_id = $request->input('doctor_id');
        $bill->examinationprice = $request->input('examinationprice');
        $bill->dispenser_id = 0;
        $bill->dispensedatetime = '';

        $bill_detail_input = $request->input('bill_detail');
        if(count($bill_detail_input) > 0){
            $bill->save();

            $enclitic = Enclitic::find($bill->enclitic_id);
            $enclitic->status_id = 3;
            $enclitic->save();

        	if($bill !== NULL){
        		$bill_detail = [];
        		foreach ($bill_detail_input as $key => $value) {
        			$bill_detail_create = new BillDetail;

        			$bill_detail_create->bill_id = $bill->id;
        			$bill_detail_create->medicine_id = $value['medicine_id'];
        			$bill_detail_create->price = $value['price'];
        			$bill_detail_create->timesperday = $value['timesperday'];
        			$bill_detail_create->daydrink = $value['daydrink'];
        			$bill_detail_create->number = $value['number'];
        			$bill_detail_create->daycount = $value['daycount'];
        			$bill_detail_create->description = $value['description']; 

        			$bill_detail_create->save();

        		}
	          return response()->json([
	              'message' => 'Bill was created',
	              'data' => $bill->id,
	              'code' => 200
	          ]);
	        }else{
	          return response()->json([
	              'message' => 'Could not create bill',
	              'data' => 'true',
	              'code' => 201
	          ]);
	        }
    	}else{
    		return response()->json([
              'message' => 'Please add medicine.',
              'data' => 'true',
              'code' => 202
          ]);
    	}
        
    }

    public function update(Request $request, $id) {
        $bill = Bill::find($id);
        if($bill !== null){
        	if(isset($request->symptom)){
        	$bill->symptom = $request->input('symptom');
        	}
	        if(isset($request->diagnosis_id)){
	        	$bill->diagnosis_id = $request->input('diagnosis_id');
	        }
	        if(isset($request->subdiagnosis)){
	        	$bill->subdiagnosis = $request->input('subdiagnosis');
	        }
	        if(isset($request->introduction)){
	        	$bill->introduction = $request->input('introduction');
	        }
	        if(isset($request->nextdate)){
	        	$bill->nextdate = $request->input('nextdate');
	        }
	        if(isset($request->index)){
	        	$bill->index = $request->input('index');
	        }
	        if(isset($request->dispenser_id)){
	        	$bill->dispenser_id = $request->input('dispenser_id');
	        }
	        if(isset($request->dispensedatetime)){
	        	$bill->dispensedatetime = $request->input('dispensedatetime');
	        }

	        if(isset($request->bill_detail)){
	        	$bill_detail_input = $request->input('bill_detail');
	        	if(count($bill_detail_input) > 0){
	        		$listPatient = BillDetail::where('bill_id', $bill->id)->delete();
	        	}
	        	$bill_detail = [];
	    		foreach ($bill_detail_input as $key => $value) {
	    			$bill_detail_create = new BillDetail;

	    			$bill_detail_create->bill_id = $bill->id;
	    			$bill_detail_create->medicine_id = $value['medicine_id'];
	    			$bill_detail_create->price = $value['price'];
	    			$bill_detail_create->timesperday = $value['timesperday'];
	    			$bill_detail_create->daydrink = $value['daydrink'];
	    			$bill_detail_create->number = $value['number'];
	    			$bill_detail_create->daycount = $value['daycount'];
	    			$bill_detail_create->description = $value['description']; 

	    			$bill_detail_create->save();

	    			array_push($bill_detail, $bill_detail_create);
	    		}
	        	// $bill['bill_detail'] = $bill_detail;
	        }

	        $bill->save();
	        $bill['bill_detail'] = $bill_detail;
	        return response()->json([
	            'message' => 'Bill was updated.',
	            'data' => $bill,
	            'code' => 200
	        ]);
        }else{
        	return response()->json([
	            'message' => 'Bill cound not found.',
	            'data' => 'true',
	            'code' => 202
	        ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $bill = Bill::find($id);
        $bill->delete();
        //
        $listPatient = BillDetail::where('bill_id', $id)->delete();
        return response()->json([
            'message' => 'Bill deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }
}
