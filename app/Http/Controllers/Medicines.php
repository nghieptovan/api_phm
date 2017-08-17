<?php
namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Medicines extends Controller {

    public function index($id = null) {
        if ($id == null) {
            $medicines = Medicine::with('phanloai', 'quycachsudung')->orderBy('id', 'asc')->get();
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
        $medicine->typemedicine_id = $request->input('typemedicine_id');
        $medicine->usingmedicine_id = $request->input('usingmedicine_id');
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
        if(isset($request->mathuoc))
          $medicine->mathuoc = $request->input('mathuoc');

        if(isset($request->tenthuoc))
          $medicine->tenthuoc = $request->input('tenthuoc');

        if(isset($request->tenthuoc_toa))
          $medicine->tenthuoc_toa = $request->input('tenthuoc_toa');

        if(isset($request->typemedicine_id))
          $medicine->typemedicine_id = $request->input('typemedicine_id');

        if(isset($request->usingmedicine_id))
          $medicine->usingmedicine_id = $request->input('usingmedicine_id');

        if(isset($request->soluong))
          $medicine->soluong = $request->input('soluong');

        if(isset($request->dongia))
          $medicine->dongia = $request->input('dongia');

        if(isset($request->nhandang))
          $medicine->nhandang = $request->input('nhandang');

        if(isset($request->soluongxuat))
          $medicine->soluongxuat = $request->input('soluongxuat');

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
