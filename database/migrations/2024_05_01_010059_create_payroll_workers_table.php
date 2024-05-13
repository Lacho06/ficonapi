<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payroll_workers', function (Blueprint $table) {
            $table->id();
            $table->float('salaryRate');
            $table->integer('hours');
            $table->float('toCollect');
            $table->float('bonus');
            $table->float('pat');
            $table->float('earnedSalary');
            $table->float('salaryTax');
            $table->float('withHoldings');
            $table->float('paid');
            $table->unsignedBigInteger('payroll_id');
            $table->unsignedBigInteger('prepayrollworker_id');
            $table->foreign('payroll_id')->references('id')->on('payrolls')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('prepayrollworker_id')->references('id')->on('pre_payroll_workers')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_workers');
    }
};
