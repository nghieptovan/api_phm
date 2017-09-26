<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class Units extends Controller
{
    //
    public function index($id = null) {
        if ($id == null) {
            $typeMedicines = Unit::orderBy('id', 'asc')->get();
            if(count($typeMedicines) > 0){
              return response()->json([
                  'message' => 'UnitTofMedicine was found',
                  'data' => $typeMedicines,
                  'code' => 200
              ]);
            }else{
              return response()->json([
                  'message' => 'UnitTofMedicine was not found',
                  'data' => 'true',
                  'code' => 201
              ]);
            }

        } else {
            return $this->show($id);
        }
    }

    public function show($id) {
        $drug = Unit::find($id);
        if($drug !== NULL){
          return response()->json([
              'message' => 'UnitTofMedicine was found',
              'data' => $drug,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'UnitTofMedicine was not found',
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
        $typeMedicine = new Unit;

        $typeMedicine->name = $request->input('name');
        $typeMedicine->code = $request->input('code');
        $typeMedicine->save();

        if($typeMedicine !== NULL){
          return response()->json([
              'message' => 'UnitTofMedicine was created',
              'data' => $typeMedicine,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create UnitTofMedicine',
              'data' => 'true',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $typeMedicine = Unit::find($id);
        if($typeMedicine !== NULL){
	        if(isset($request->name))
	          $typeMedicine->name = $request->input('name');
	        if(isset($request->code))
	          $typeMedicine->code = $request->input('code');

        	$typeMedicine->save();
	        return response()->json([
	            'message' => 'UnitTofMedicine was updated.',
	            'data' => $typeMedicine,
	            'code' => 200
	        ]);
    	}else{
    		return response()->json([
              'message' => 'Can not find UnitTofMedicine with id = '.$id,
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
        $typeMedicine = Unit::find($id);
        $typeMedicine->delete();
        //
        return response()->json([
            'message' => 'UnitTofMedicine deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }
}
