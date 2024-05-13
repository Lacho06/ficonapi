<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use App\Models\Worker;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    public function index(){
        $occupations = Occupation::all();

        return response()->json($occupations, 200);
    }

    public function show($id){
        $occupation = Occupation::find($id);

        if(!$occupation){
            return response()->json([
                'message' => 'Occupation not found'
            ], 404);
        }

        return response()->json([
            'id' => $occupation->id,
            'name' => $occupation->name,
            'salary' => $occupation->salary,
            'workers' => $occupation->workers,
        ], 200);
    }

    public function showByCode($code){
        $worker = Worker::where('code', $code)->first();

        $occupation = Occupation::find($worker->occupation->id);

        return response()->json([
            'name' => $occupation->name,
            'salary' => $occupation->salary,
        ], 200);
    }

    public function store(Request $request){
        $newOccupation = Occupation::create([
            'name' => $request->name,
            'salary' => $request->salary
        ]);

        return response()->json($newOccupation, 201);
    }

    public function update(Request $request, $id){
        $occupation = Occupation::find($id);

        if($request->name){
            $occupation->update([
                'name' => $request->name,
            ]);
        }
        if($request->salary){
            $occupation->update([
                'salary' => $request->salary,
            ]);
        }

        return response()->json($occupation, 200);
    }

    public function destroy($id){
        $occupation = Occupation::find($id);
        $occupation->delete();

        return response()->json([
            'message' => 'Cargo eliminado correctamente'
        ], 200);
    }
}
