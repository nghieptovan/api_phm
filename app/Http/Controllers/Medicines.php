<?php
namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Medicines extends Controller {

    public function index($id = null) {
        if ($id == null) {
            $medicines = Medicine::orderBy('id', 'asc')->get();
            if(count($medicines) > 0){
              return response()->json([
                  'message' => 'Medicines was found',
                  'data' => $medicines,
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
        $medicine = new Medicine;

        $medicine->mathuoc = $request->input('mathuoc');
        $medicine->tenthuoc = $request->input('tenthuoc');
        $medicine->tenthuoc_toa = $request->input('tenthuoc_toa');
        $medicine->quicachsudung = $request->input('quicachsudung');
        $medicine->phanloai = $request->input('phanloai');
        $medicine->soluong = $request->input('soluong');
        $medicine->dongia = $request->input('dongia');
        $medicine->nhandang = $request->input('nhandang');
        $medicine->save();

        if($medicine !== NULL){
          return response()->json([
              'message' => 'Medicine was created',
              'data' => $medicine,
              'code' => 200
          ]);
        }else{
          return response()->json([
              'message' => 'Could not create medicine',
              'code' => 201
          ]);
        }
    }

    public function update(Request $request, $id) {
        $medicine = Medicine::find($id);

        $medicine->mathuoc = $request->input('mathuoc');
        $medicine->tenthuoc = $request->input('tenthuoc');
        $medicine->tenthuoc_toa = $request->input('tenthuoc_toa');
        $medicine->quicachsudung = $request->input('quicachsudung');
        $medicine->phanloai = $request->input('phanloai');
        $medicine->soluong = $request->input('soluong');
        $medicine->dongia = $request->input('dongia');
        $medicine->nhandang = $request->input('nhandang');

        $medicine->save();
        return response()->json([
            'message' => 'Medicine was updated.',
            'data' => $medicine,
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
        $medicine = Medicine::find($id);
        $medicine->delete();
        //
        return response()->json([
            'message' => 'Medicine deleted success.',
            'code' => 200
        ]);
    }

}
