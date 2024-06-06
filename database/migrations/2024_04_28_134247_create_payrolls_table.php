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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buildedBy');
            $table->unsignedBigInteger('reviewBy');
            $table->unsignedBigInteger('approvedBy');
            $table->unsignedBigInteger('doneBy');
            $table->unsignedBigInteger('prepayroll_id');
            $table->foreign('buildedBy')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('reviewBy')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('approvedBy')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('doneBy')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('prepayroll_id')->references('id')->on('pre_payrolls')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
