<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Occupation;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index(){
        $workers = Worker::all();
        return response()->json($workers, 200);
    }

    public function show($code){
        $worker = Worker::where('code', $code)->first();

        return response()->json([
            'id' => $worker->id,
            'code' => $worker->code,
            'name' => $worker->name,
            'ci' => $worker->ci,
            'category' => $worker->category,
            'occupation' => $worker->occupation->name,
            'salary' => $worker->occupation->salary,
        ], 200);
    }


    public function store(Request $request){
        $occupation = Occupation::where('id', $request->occupationId)->first();
        $department = Department::where('code', $request->departmentCode)->first();

        $newWorker = Worker::create([
            'code' => $request->ci % 100000,
            'name' => $request->name,
            'ci' => $request->ci,
            'category' => $request->category,
            'occupation_id' => $occupation->id,
            'department_id' => $department->id,
        ]);

        return response()->json($newWorker, 201);
    }

    public function update(Request $request, $code){
        $worker = Worker::where('code', $code)->first();
        $occupation = Occupation::where('id', $request->occupationId)->first();
        $department = Department::where('code', $request->departmentCode)->first();

        if($occupation){
            $worker->update([
                'occupation_id' => $occupation->id,
            ]);
        }
        if($department){
            $worker->update([
                'department_id' => $department->id,
            ]);
        }
        if($request->ci){
            $worker->update([
                'code' => $request->ci % 100000,
                'ci' => $request->ci,
            ]);
        }

        if($request->name){
            $worker->update([
                'name' => $request->name,
            ]);
        }
        if($request->category){
            $worker->update([
                'category' => $request->category,
            ]);
        }

        return response()->json($worker, 200);
    }

    public function destroy($code){
        $worker = Worker::where('code', $code)->first();
        $worker->delete();

        return response()->json([
            'message' => 'Trabajador eliminado correctamente'
        ], 200);
    }
}
