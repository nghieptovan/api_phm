<?php

namespace App\Http\Controllers;

use App\PatentMedicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class PatentMedicines extends Controller
{
    //
    public function index($id = null) {
        if ($id == null) {
            $drugs = PatentMedicine::orderBy('id', 'asc')->get();
            if(count($drugs) > 0){
              return response()->json([
                  'message' => 'PatentMedicine was found',
                  'data' => $drugs,
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
        $drug = PatentMedicine::find($id);
        if($drug !== NULL){
          return response()->json([
              'message' => 'PatentMedicine was found',
              'data' => $drug,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'PatentMedicine was not found',
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
        $drug = new PatentMedicine;

        $drug->name = $request->input('name');
        $drug->code = $request->input('code');
        $drug->save();

        if($drug !== NULL){
          return response()->json([
              'message' => 'PatentMedicine was created',
              'data' => $drug,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create PatentMedicine',
              'data' => 'true',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $drug = PatentMedicine::find($id);
        if($drug !== NULL){
	        if(isset($request->name))
	          $drug->name = $request->input('name');
	        if(isset($request->code))
	          $drug->code = $request->input('code');

        	$drug->save();
	        return response()->json([
	            'message' => 'PatentMedicine was updated.',
	            'data' => $drug,
	            'code' => 200
	        ]);
    	}else{
    		return response()->json([
              'message' => 'Can not find PatentMedicine with id = '.$id,
              'data' => 'true',
              'code' => 201
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
        $drug = PatentMedicine::find($id);
        $drug->delete();
        //
        return response()->json([
            'message' => 'PatentMedicine deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }
}
