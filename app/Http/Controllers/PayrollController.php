<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\PayrollWorker;
use App\Models\PrePayroll;
use App\Models\PrePayrollWorker;
use App\Models\Worker;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index(){
        $payrolls = Payroll::with(['prepayroll', 'payrollWorkers'])->get();
        $resp = [];

        foreach($payrolls as $payroll){
            array_push($resp, [
                'id' => $payroll->id,
                'month' => $payroll->prepayroll->month,
                'year' => $payroll->prepayroll->year,
                'workers' => $payroll->payrollWorkers,
            ]);
        }

        return response()->json($resp, 200);
    }

    public function show($id){
        $payroll = Payroll::with(['payrollWorkers.prepayrollWorker.worker.department.area', 'payrollWorkers.prepayrollWorker.worker.occupation'])->find($id);

        $allWorkers = $payroll->payrollWorkers->map(function ($payrollWorker) {
            return [
                'salaryRate' => $payrollWorker->salaryRate,
                'hours' => $payrollWorker->hours,
                'toCollect' => $payrollWorker->toCollect,
                'bonus' => $payrollWorker->bonus,
                'pat' => $payrollWorker->pat,
                'earnedSalary' => $payrollWorker->earnedSalary,
                'salaryTax' => $payrollWorker->salaryTax,
                'withHoldings' => $payrollWorker->withHoldings,
                'paid' => $payrollWorker->paid,
                'worker' => [
                    'code' => $payrollWorker->prepayrollWorker->worker->code,
                    'name' => $payrollWorker->prepayrollWorker->worker->name,
                    'ci' => $payrollWorker->prepayrollWorker->worker->ci,
                    'category' => $payrollWorker->prepayrollWorker->worker->category,
                ],
                'occupation' => [
                    'name' => $payrollWorker->prepayrollWorker->worker->occupation->name,
                    'salary' => $payrollWorker->prepayrollWorker->worker->occupation->salary,
                ],
                'department' => [
                    'code' => $payrollWorker->prepayrollWorker->worker->department->code,
                    'name' => $payrollWorker->prepayrollWorker->worker->department->name,
                ],
                'area' => [
                    'code' => $payrollWorker->prepayrollWorker->worker->department->area->code,
                    'name' => $payrollWorker->prepayrollWorker->worker->department->area->name,
                ],
            ];
        });

        $sortedWorkers = $allWorkers->sortBy(function ($payrollWorker) {
            return "{$payrollWorker['area']['name']} {$payrollWorker['department']['name']} {$payrollWorker['worker']['name']}";
        });

        return response()->json([
            'month' => $payroll->prepayroll->month,
            'year' => $payroll->prepayroll->year,
            'workers' => $sortedWorkers->values()->all(),
        ], 200);
    }

    public function store(Request $request){
        $prepayroll = PrePayroll::where('month', $request->month)->where('year', $request->year)->first();

        $newPayroll = Payroll::create([
            'prepayroll_id' => $prepayroll->id
        ]);

        foreach($request->workers as $payrollWorker){
            $worker = Worker::where('code', $payrollWorker['worker']['code'])->first();
            $prepayrollWorker = PrePayrollWorker::where('prepayroll_id', $prepayroll->id)->where('worker_id', $worker->id)->first();

            PayrollWorker::create([
                'salaryRate' => $payrollWorker['salaryRate'],
                'hours' => $payrollWorker['hours'],
                'toCollect' => $payrollWorker['toCollect'],
                'bonus' => $payrollWorker['bonus'],
                'pat' => $payrollWorker['pat'],
                'earnedSalary' => $payrollWorker['earnedSalary'],
                'salaryTax' => $payrollWorker['salaryTax'],
                'withHoldings' => $payrollWorker['withHoldings'],
                'paid' => $payrollWorker['paid'],
                'payroll_id' => $newPayroll->id,
                'prepayrollworker_id' => $prepayrollWorker->id,
            ]);
        }

        return response()->json($newPayroll, 201);
    }
}
