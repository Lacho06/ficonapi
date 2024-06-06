<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\PrePayroll;
use App\Models\PrePayrollWorker;
use App\Models\Worker;
use Illuminate\Http\Request;

class PrePayrollController extends Controller
{
    public function index(){
        $prePayrolls = PrePayroll::all();
        return response()->json($prePayrolls, 200);
    }

    public function listReserved(){
        $prePayrolls = PrePayroll::all();
        $payrolls = Payroll::all();
        $response = [];

        foreach($prePayrolls as $prePayroll){
            $isAdded = false;
            foreach($payrolls as $payroll){
                if($prePayroll->id === $payroll->prepayroll->id){
                    $isAdded = true;
                }
            }
            if(!$isAdded){
                array_push($response, $prePayroll);
            }
            $isAdded = false;
        }

        return response()->json($response, 200);
    }

    public function showWorkers($id){
        $prePayroll = PrePayroll::with(['prepayrollWorker.worker.department.area', 'prepayrollWorker.worker.occupation'])->find($id);

        $allWorkers = $prePayroll->prepayrollWorker->map(function ($prepayrollWorker) {
            return [
                'code' => $prepayrollWorker->worker->code,
                'name' => $prepayrollWorker->worker->name,
                'ci' => $prepayrollWorker->worker->ci,
                'hTrab' => $prepayrollWorker->hoursWorked,
                'hNoTrab' => $prepayrollWorker->hoursNotWorked,
                'impunt' => $prepayrollWorker->tardiness,
                'diasVac' => $prepayrollWorker->vacationDays,
                'hrsCertif' => $prepayrollWorker->hoursCertificate,
                'hrsLicMatern' => $prepayrollWorker->hoursMaternityLicence,
                'hrsResol' => $prepayrollWorker->hoursResolution,
                'hrsInterr' => $prepayrollWorker->hoursInterrupted,
                'otroTpoPagar' => $prepayrollWorker->anotherTpoPay,
                'hrsExtras' => $prepayrollWorker->hoursExtra,
                'worker' => [
                    'code' => $prepayrollWorker->worker->code,
                    'name' => $prepayrollWorker->worker->name,
                    'ci' => $prepayrollWorker->worker->ci,
                    'category' => $prepayrollWorker->worker->category,
                ],
                'occupation' => [
                    'name' => $prepayrollWorker->worker->occupation->name,
                    'salary' => $prepayrollWorker->worker->occupation->salary,
                ],
                'department' => [
                    'code' => $prepayrollWorker->worker->department->code,
                    'name' => $prepayrollWorker->worker->department->name,
                ],
                'area' => [
                    'code' => $prepayrollWorker->worker->department->area->code,
                    'name' => $prepayrollWorker->worker->department->area->name,
                ],
            ];
        });

        $sortedWorkers = $allWorkers->sortBy(function ($prepayrollWorker) {
            return "{$prepayrollWorker['area']['name']} {$prepayrollWorker['department']['name']} {$prepayrollWorker['worker']['name']}";
        });

        return response()->json([
            'id' => $prePayroll->id,
            'month' => $prePayroll->month,
            'year' => $prePayroll->year,
            'workers' => $sortedWorkers->values()->all(),
        ], 200);

    }

     public function store(Request $request){
        $newPrePayroll = PrePayroll::create([
            'month' => $request->month,
            'year' => $request->year,
        ]);

        return response()->json($newPrePayroll, 201);
    }

    public function storePrePayrollWorker(Request $request){
        $prePayroll = PrePayroll::find($request->prepayrollId);
        $worker = Worker::where('ci', $request->workerId)->first();

        $newPrePayrollWorker = PrePayrollWorker::create([
            'hoursWorked' => $request->hTrab,
            'hoursNotWorked' => $request->hNoTrab,
            'tardiness' => $request->impunt,
            'hoursCertificate' => $request->hrsCertif,
            'hoursMaternityLicence' => $request->hrsLicMatern,
            'hoursResolution' => $request->hrsResol,
            'hoursInterrupted' => $request->hrsInterr,
            'hoursExtra' => $request->hrsExtras,
            'anotherTpoPay' => $request->otroTpoPagar,
            'vacationDays' => $request->diasVac,
            'prepayroll_id' => $prePayroll->id,
            'worker_id' => $worker->id,
        ]);

        return response()->json($newPrePayrollWorker, 201);
    }
}
