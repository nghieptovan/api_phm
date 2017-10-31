<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Patient;
use App\Employee;
use App\Enclitic;
use App\Config;
use App\Medicine;
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

    public function getBillReport(Request $request) {

      $fromDate = date('Y-m-d', strtotime($request->input('fromDate')));

      $toDate = date('Y-m-d', strtotime($request->input('toDate')));

      if(isset($request->doctor_id)){
        $doctor_id = $request->input('doctor_id');  
        

        $bills = Bill::where('doctor_id', $doctor_id)
        ->whereBetween('created_at',  [$fromDate, $toDate])
        ->get();
        if(count($bills)>0){
              foreach ($bills as $key => $value) {        
                $getMoneyDrug = $this->getMoneyDrug($value['id']);
                $bills[$key]['totalmoneydrug'] = $getMoneyDrug;    

                $patient = $this->getPatient($value['patient_id']);   
                $bills[$key]['patient'] = $patient;    


                $doctor = $this->getEmployee($value['doctor_id']);
                $bills[$key]['doctor'] = $doctor;
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
      }else{
        $bills = Bill::whereBetween('created_at',  [$fromDate, $toDate])->get();
        if(count($bills)>0){
              foreach ($bills as $key => $value) {        
                $getMoneyDrug = $this->getMoneyDrug($value['id']);
                $bills[$key]['totalmoneydrug'] = $getMoneyDrug;    

                $patient = $this->getPatient($value['patient_id']);   
                $bills[$key]['patient'] = $patient;   

                $doctor = $this->getEmployee($value['doctor_id']);
                $bills[$key]['doctor'] = $doctor; 
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
      }

      

    }

    public function getByPatient($patient_id) {
        if ($patient_id !== null) {
            $bills = Bill::where('patient_id', $patient_id)->with('Diagnosis')->get();
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
    public function getMoneyDrug($id){
      $details = BillDetail::where('bill_id', $id)->get();
      $moneyDrug = 0;
      foreach ($details as $key => $value) {
        $amount = $value->number * $value->daycount * $value->timesperday;
        $moneyDrug += $value->price * $amount;
      }
      return $moneyDrug;
      
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
    	$details = BillDetail::where('bill_id', $id)->get();
      foreach ($details as $key => $value) {
        # code...
         $medicines = Medicine::with('TypeMedicine', 'BehaviourMedicine', 'Unit', 'Drug', 'PatentMedicine')->find($value->medicine_id);
        if(count($medicines) == 1){
          $details[$key]['medicine'] = $medicines;
        }
      }
     
    	if(count($details) > 0){
    		return $details;
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
        $config = Config::where('key', 'tienkham')->get();
        if(count($config) > 0){
          $priceExam = $config[0]->value;
        }else{
          $priceExam = '120000';
        }
        
        $bill = new Bill;
        $bill->patient_id = $request->input('patient_id');
        $bill->enclitic_id = $request->input('enclitic_id');        
        $bill->billdate = date("d/m/Y h:i:s");        

        if(isset($request->symptom)){
          $bill->symptom = $request->input('symptom');
        }else{
          $bill->symptom = '';
        }
        if(isset($request->diagnosis_id)){
          $bill->diagnosis_id = $request->input('diagnosis_id');
        }else{
          $bill->diagnosis_id = 0;
        }
        if(isset($request->subdiagnosis)){
          $bill->subdiagnosis = $request->input('subdiagnosis');
        }else{
          $bill->subdiagnosis = '';
        }
        if(isset($request->maindiagnosis)){
          $bill->maindiagnosis = $request->input('maindiagnosis');
        }else{
          $bill->maindiagnosis = '';
        }
        if(isset($request->introduction)){
          $bill->introduction = $request->input('introduction');
        }else{
          $bill->introduction = '';
        }
        if(isset($request->totalmoney)){
          $bill->totalmoney = $request->input('totalmoney');
        }else{
          $bill->totalmoney = '';
        }
        if(isset($request->drugmoney)){
          $bill->drugmoney = $request->input('drugmoney');
        }else{
          $bill->drugmoney = '';
        }
        
        if(isset($request->nextdate)){
          $bill->nextdate = $request->input('nextdate');
        }else{
          $bill->nextdate = '';
        }
        if(isset($request->index)){
          $bill->index = $request->input('index');
        }else{
          $bill->index = 0;
        }
        if(isset($request->doctor_id)){
          $bill->doctor_id = $request->input('doctor_id');
        }else{
          $bill->doctor_id = 0;
        }
        
        $bill->examinationprice = $priceExam;
        $bill->dispenser_id = 0;
        $bill->dispensedatetime = '';

        $bill_detail_input = $request->input('bill_detail');

        if($bill->nextdate !== ''){
          $enclitic = new Enclitic;
          $enclitic->status_id = 2;
          $enclitic->patient_id = $bill->patient_id;
          $enclitic->employee_id = $bill->doctor_id;
          $enclitic->date = $bill->nextdate;
          $enclitic->save();
        }
        if(count($bill_detail_input) > 0){
            $bill->save();

            $enclitic = Enclitic::find($bill->enclitic_id);
            $enclitic->status_id = 3;
            $enclitic->save();

        	if($bill !== NULL){
        		$bill_detail = [];
        		foreach ($bill_detail_input as $key => $value) {
              $medicine_id_detail = $value['medicine_id'];
              $getMedicineDetail = Medicine::find($medicine_id_detail);

        			$bill_detail_create = new BillDetail;

        			$bill_detail_create->bill_id = $bill->id;
        			$bill_detail_create->medicine_id = $value['medicine_id'];
        			$bill_detail_create->price = $getMedicineDetail->sellprice;
              $bill_detail_create->description = $getMedicineDetail->description;
        			$bill_detail_create->timesperday = $value['timesperday'];
        			$bill_detail_create->daydrink = $value['daydrink'];
        			$bill_detail_create->number = $value['number'];
        			$bill_detail_create->daycount = $value['daycount'];        			

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
          if(isset($request->maindiagnosis)){
            $bill->maindiagnosis = $request->input('maindiagnosis');
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

          if(isset($request->totalmoney)){
            $bill->totalmoney = $request->input('totalmoney');
          }
          if(isset($request->drugmoney)){
            $bill->drugmoney = $request->input('drugmoney');
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
