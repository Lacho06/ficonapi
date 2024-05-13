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
        Schema::create('pre_payroll_workers', function (Blueprint $table) {
            $table->id();
            $table->integer('hoursWorked');
            $table->integer('hoursNotWorked');
            $table->integer('tardiness');
            $table->integer('hoursCertificate');
            $table->integer('hoursMaternityLicence');
            $table->integer('hoursResolution');
            $table->integer('hoursInterrupted');
            $table->integer('hoursExtra');
            $table->integer('anotherTpoPay');
            $table->integer('vacationDays');
            $table->unsignedBigInteger('prepayroll_id');
            $table->unsignedBigInteger('worker_id');
            $table->foreign('prepayroll_id')->references('id')->on('pre_payrolls')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('worker_id')->references('id')->on('workers')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_payroll_workers');
    }
};
