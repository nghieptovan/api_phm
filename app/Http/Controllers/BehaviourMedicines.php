<?php

namespace App\Http\Controllers;

use App\BehaviourMedicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class BehaviourMedicines extends Controller
{
    //
    public function index($id = null) {
        if ($id == null) {
            $behaviourMedicine = BehaviourMedicine::orderBy('id', 'asc')->get();
            if(count($behaviourMedicine) > 0){
              return response()->json([
                  'message' => 'BehaviourMedicine was found',
                  'data' => $behaviourMedicine,
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
    public function store(Request $request) {
        $behaviourMedicine = new BehaviourMedicine;

        $behaviourMedicine->name = $request->input('name');
        $behaviourMedicine->code = $request->input('code');
        $behaviourMedicine->save();

        if($behaviourMedicine !== NULL){
          return response()->json([
              'message' => 'BehaviourMedicine was created',
              'data' => $behaviourMedicine,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create BehaviourMedicine',
              'data' => 'true',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $behaviourMedicine = BehaviourMedicine::find($id);
        if($behaviourMedicine !== null){
        	if(isset($request->name))
      			$behaviourMedicine->name = $request->input('name');
	        if(isset($request->code))
	         	$behaviourMedicine->code = $request->input('code');

	        $behaviourMedicine->save();
	        return response()->json([
	            'message' => 'BehaviourMedicine was updated.',
	            'data' => $behaviourMedicine,
	            'code' => 200
	        ]);
        }else{
    		return response()->json([
              'message' => 'Can not find BehaviourMedicine with id = '.$id,
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
        $behaviourMedicine = BehaviourMedicine::find($id);
        $behaviourMedicine->delete();
        //
        return response()->json([
            'message' => 'BehaviourMedicine deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }
}
