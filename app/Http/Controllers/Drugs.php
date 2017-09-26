<?php

namespace App\Http\Controllers;

use App\Drug;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class Drugs extends Controller
{
    //
    public function index($id = null) {
        if ($id == null) {
            $drugs = Drug::orderBy('id', 'asc')->get();
            if(count($drugs) > 0){
              return response()->json([
                  'message' => 'Drugs was found',
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
        $drug = Drug::find($id);
        if($drug !== NULL){
          return response()->json([
              'message' => 'Drug was found',
              'data' => $drug,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Drug was not found',
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
        $drug = new Drug;

        $drug->name = $request->input('name');
        $drug->code = $request->input('code');
        $drug->save();

        if($drug !== NULL){
          return response()->json([
              'message' => 'Drug was created',
              'data' => $drug,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create drug',
              'data' => 'true',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $drug = Drug::find($id);
        if($drug !== NULL){
	        if(isset($request->name))
	          $drug->name = $request->input('name');
	        if(isset($request->code))
	          $drug->code = $request->input('code');

        	$drug->save();
	        return response()->json([
	            'message' => 'Drug was updated.',
	            'data' => $drug,
	            'code' => 200
	        ]);
    	}else{
    		return response()->json([
              'message' => 'Can not find Drug with id = '.$id,
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
        $drug = Drug::find($id);
        $drug->delete();
        //
        return response()->json([
            'message' => 'Drug deleted success.',
            'data' => 'true',
            'code' => 200
        ]);
    }
}
