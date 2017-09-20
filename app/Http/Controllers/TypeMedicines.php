<?php

namespace App\Http\Controllers;

use App\TypeMedicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class TypeMedicines extends Controller
{
    //
    public function index($id = null) {
        if ($id == null) {
            $typeMedicines = TypeMedicine::orderBy('id', 'asc')->get();
            if(count($typeMedicines) > 0){
              return response()->json([
                  'message' => 'TypeMedicines was found',
                  'data' => $typeMedicines,
                  'code' => 200
              ]);
            }else{
              return response()->json([
                  'message' => 'Data was not found',
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
        $typeMedicine = new TypeMedicine;

        $typeMedicine->name = $request->input('name');
        $typeMedicine->code = $request->input('code');
        $typeMedicine->save();

        if($typeMedicine !== NULL){
          return response()->json([
              'message' => 'TypeMedicine was created',
              'data' => $typeMedicine,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create TypeMedicine',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $typeMedicine = TypeMedicine::find($id);
        if($typeMedicine !== NULL){
	        if(isset($request->name))
	          $typeMedicine->name = $request->input('name');
	        if(isset($request->code))
	          $typeMedicine->code = $request->input('code');

        	$typeMedicine->save();
	        return response()->json([
	            'message' => 'TypeMedicine was updated.',
	            'data' => $typeMedicine,
	            'code' => 200
	        ]);
    	}else{
    		return response()->json([
              'message' => 'Can not find TypeMedicine with id = '.$id,
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
        $typeMedicine = TypeMedicine::find($id);
        $typeMedicine->delete();
        //
        return response()->json([
            'message' => 'TypeMedicine deleted success.',
            'code' => 200
        ]);
    }
}
