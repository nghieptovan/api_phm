<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Configs extends Controller
{
    //
    public function index($id = null) {
        if ($id == null) {
            $configs = Config::orderBy('id', 'asc')->get();
            if(count($configs) > 0){
              return response()->json([
                  'message' => 'Configs was found',
                  'data' => $configs,
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

    public function show($id) {
        $config = Config::find($id);
        if($config !== NULL){
          return response()->json([
              'message' => 'Config was found',
              'data' => $config,
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $config = new Config;
        $config->key = $request->input('key');

        $config->value = $request->input('value');


        $config->save();

        if($config !== NULL){
          return response()->json([
              'message' => 'Config was created',
              'data' => $config,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create Config',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $config = Config::find($id);
        if(isset($request->key))
          $config->key = $request->input('key');

        if(isset($request->value))
          $config->value = $request->input('value');

        $config->save();
        return response()->json([
            'message' => 'Config was updated.',
            'data' => $config,
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
        $config = Config::find($id);
        $config->delete();
        //
        return response()->json([
            'message' => 'Config deleted success.',
            'code' => 200
        ]);
    }
}
