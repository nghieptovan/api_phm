<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;


class Diagnosises extends Controller
{
    //
    //
    public function index($id = null) {
        if ($id == null) {
            $diagnosises = Diagnosis::orderBy('id', 'asc')->get();
            if(count($diagnosises) > 0){
              return response()->json([
                  'message' => 'Diagnosis was found',
                  'data' => $diagnosises,
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
        $diagnosis = new Diagnosis;

        $diagnosis->name = $request->input('name');
        $diagnosis->code = $request->input('code');
        $diagnosis->short_name = $request->input('short_name');
        $diagnosis->save();

        if($status !== NULL){
          return response()->json([
              'message' => 'Diagnosis was created',
              'data' => $diagnosis,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create Diagnosis',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $diagnosis = Diagnosis::find($id);

        if(isset($request->name))
          $diagnosis->name = $request->input('name');
        if(isset($request->code))
          $diagnosis->code = $request->input('code');
        if(isset($request->short_name))
          $diagnosis->short_name = $request->input('short_name');

        $diagnosis->save();
        return response()->json([
            'message' => 'Diagnosis was updated.',
            'data' => $diagnosis,
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
        $diagnosis = Diagnosis::find($id);
        $diagnosis->delete();
        //
        return response()->json([
            'message' => 'Diagnosis deleted success.',
            'code' => 200
        ]);
    }
}
