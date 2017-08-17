<?php
namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Statuses extends Controller
{
    //
    public function index($id = null) {
        if ($id == null) {
            $statuses = Status::orderBy('id', 'asc')->get();
            if(count($statuses) > 0){
              return response()->json([
                  'message' => 'Status was found',
                  'data' => $statuses,
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
        $status = new Status;

        $status->status_name = $request->input('status_name');

        $status->save();

        if($status !== NULL){
          return response()->json([
              'message' => 'Status was created',
              'data' => $status,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create status',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $status = Status::find($id);
        if(isset($request->status_name))
          $status->status_name = $request->input('status_name');
        $status->save();
        return response()->json([
            'message' => 'Status was updated.',
            'data' => $status,
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
        $status = Status::find($id);
        $status->delete();
        //
        return response()->json([
            'message' => 'Status deleted success.',
            'code' => 200
        ]);
    }
}
