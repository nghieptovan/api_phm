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
            $employees = Employee::orderBy('id', 'asc')->get();
            if(count($employees) > 0){
              return response()->json([
                  'message' => 'Nhân viên tìm thấy',
                  'data' => $employees,
                  'code' => 200
              ]);
            }else{
              return response()->json([
                  'message' => 'Không tìm thấy nhân viên nào',
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
        $employee->save();

        return 'Employee record successfully created with id ' . $employee->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Employee::find($id);
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
        $employee->save();

        return "Sucess updating user #" . $employee->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request) {
        $employee = Employee::find($request->input('id'));

        $employee->delete();

        return "Employee record successfully deleted #" . $request->input('id');
    }
}
