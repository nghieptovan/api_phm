<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Employees extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        if ($id == null) {
            $employees = Employee::with('Role')->get();
            if(count($employees) > 0){
              return response()->json([
                  'message' => 'Employees was found',
                  'data' => $employees,
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
        $employee = new Employee;

        $employee->username = $request->input('username');
        $employee->password = $request->input('password');
        $employee->position = $request->input('position');
        $employee->role_id = $request->input('role_id');
        $employee->save();

        if($employee !== NULL){
          return response()->json([
              'message' => 'Employee was created',
              'data' => $employee,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create employee',
              'code' => 201
          ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $employee = Employee::find($id);
        if($employee !== NULL){
          return response()->json([
              'message' => 'Employee was found',
              'data' => $employee,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Employee was not found',
              'code' => 201
          ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $employee = Employee::find($id);

        $employee->username = $request->input('username');
        $employee->password = $request->input('password');
        $employee->position = $request->input('position');
        $employee->role_id = $request->input('role_id');
        $employee->save();
        return response()->json([
            'message' => 'Employee was updated.',
            'data' => $employee,
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
        $employee = Employee::find($id);
        //print_r($employee);
        $employee->delete();
        //
        return response()->json([
            'message' => 'Employee deleted success.',
            'code' => 200
        ]);
    }
}
