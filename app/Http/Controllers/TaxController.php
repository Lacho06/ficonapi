<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index(){
        $taxs = Tax::all();

        return response()->json($taxs, 200);
    }

        public function store(Request $request){
        $newTax = Tax::create([
            'type' => $request->type,
            'minValue' => $request->minValue,
            'maxValue' => $request->maxValue,
            'percentage' => $request->percentage,
        ]);

        return response()->json($newTax, 201);
    }

    public function update(Request $request, $id){
        $tax = Tax::find($id);

        if($request->type){
            $tax->update([
                'type' => $request->type,
            ]);
        }
        if($request->minValue){
            $tax->update([
                'minValue' => $request->minValue,
            ]);
        }
        if($request->maxValue){
            $tax->update([
                'maxValue' => $request->maxValue,
            ]);
        }
        if($request->percentage){
            $tax->update([
                'percentage' => $request->percentage,
            ]);
        }

        return response()->json($tax, 200);
    }

    public function destroy($id){
        $tax = Tax::find($id);
        $tax->delete();

        return response()->json([
            'message' => 'Impuesto eliminado correctamente'
        ], 200);
    }
}
