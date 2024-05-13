<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(){
        $areas = Area::all()->sortBy(function ($area){
            return "{$area['code']}";
        })->values()->all();

        return response()->json($areas, 200);
    }

    public function store(Request $request){
        $areaNumber = rand(100, 999);

        $newArea = Area::create([
            'code' => $areaNumber,
            'name' => $request->name,
        ]);

        return response()->json($newArea, 201);
    }

    public function update(Request $request, $codeArea){
        $area = Area::where('code', $codeArea)->first();

        if($request->name){
            $area->update([
                'name' => $request->name,
            ]);
        }

        return response()->json($area, 200);
    }

    public function destroy($codeArea){
        $area = Area::where('code', $codeArea)->first();
        $area->delete();

        return response()->json([
            'message' => 'Area eliminada correctamente'
        ], 200);
    }
}
