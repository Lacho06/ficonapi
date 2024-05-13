<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Department;
use App\Models\Worker;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::with('area')->get();

        $response = [];

        foreach($departments as $department){
            array_push($response, [
                'code' => $department->code,
                'name' => $department->name,
                'areaName' => $department->area->name,
            ]);
        }

        return response()->json($response, 200);
    }

    public function show($code){
        $worker = Worker::where('code', $code)->first();

        $department = Department::find($worker->department->id);

        return response()->json([
            'code' => $department->code,
            'name' => $department->name,
            'area' => [
                'name' => $department->area->name,
                'code' => $department->area->code,
            ],
        ], 200);
    }

    public function store(Request $request){
        $dptoNumber = rand(100, 999);

        $area = Area::where('name', $request->areaName)->first();

        $newDepartment = Department::create([
            'code' => $dptoNumber.'*'.$area->code,
            'name' => $request->name,
            'area_id' => $area->id
        ]);

        return response()->json($newDepartment, 201);
    }

    public function update(Request $request, $codeDpto){
        $department = Department::where('code', $codeDpto)->first();

        if($request->name){
            $department->update([
                'name' => $request->name,
            ]);
        }
        if($request->areaName){
            $area = Area::where('name', $request->areaName)->first();
            $dptoNumber = rand(100, 999);

            $department->update([
                'code' => $dptoNumber.'*'.$area->code,
                'area_id' => $area->id,
            ]);
        }

        return response()->json($department, 200);
    }

    public function destroy($codeDpto){
        $department = Department::where('code', $codeDpto)->first();
        $department->delete();

        return response()->json([
            'message' => 'Departamento eliminado correctamente'
        ], 200);
    }
}
