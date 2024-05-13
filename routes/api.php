<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PrePayrollController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

// ----- Users -----
Route::get('/users', [UserController::class, 'index']);
Route::post('/login', [UserController::class, 'login']);


// ----- Workers -----
Route::get('/workers', [WorkerController::class, 'index']);
Route::get('/worker/{code}', [WorkerController::class, 'show']);
Route::post('/worker', [WorkerController::class, 'store']);
Route::put('/worker/{code}', [WorkerController::class, 'update']);
Route::delete('/worker/{code}', [WorkerController::class, 'destroy']);


// ----- Occupation -----
Route::get('/occupations', [OccupationController::class, 'index']);
Route::get('/occupation/{id}', [OccupationController::class, 'show']);
Route::get('/occupation/worker/{code}', [OccupationController::class, 'showByCode']);
Route::post('/occupation', [OccupationController::class, 'store']);
Route::put('/occupation/{id}', [OccupationController::class, 'update']);
Route::delete('/occupation/{id}', [OccupationController::class, 'destroy']);


// ----- Departments -----
Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/department/worker/{code}', [DepartmentController::class, 'show']);
Route::post('/department', [DepartmentController::class, 'store']);
Route::put('/department/{codeDpto}', [DepartmentController::class, 'update']);
Route::delete('/department/{codeDpto}', [DepartmentController::class, 'destroy']);


// ----- Areas -----
Route::get('/areas', [AreaController::class, 'index']);
Route::post('/area', [AreaController::class, 'store']);
Route::put('/area/{codeArea}', [AreaController::class, 'update']);
Route::delete('/area/{codeArea}', [AreaController::class, 'destroy']);


// ----- Taxs -----
Route::get('/taxs', [TaxController::class, 'index']);
Route::post('/tax', [TaxController::class, 'store']);
Route::put('/tax/{id}', [TaxController::class, 'update']);
Route::delete('/tax/{id}', [TaxController::class, 'destroy']);


// ----- PrePayrolls -----
Route::get('/prepayrolls', [PrePayrollController::class, 'index']);
Route::get('/prepayroll/workers/{id}', [PrePayrollController::class, 'showWorkers']);
Route::post('/prepayroll', [PrePayrollController::class, 'store']);
Route::post('/prepayroll/worker', [PrePayrollController::class, 'storePrePayrollWorker']);



// ----- Payrolls -----
Route::get('/payrolls', [PayrollController::class, 'index']);
Route::get('/payroll/{id}', [PayrollController::class, 'show']);
Route::post('/payroll', [PayrollController::class, 'store']);
