<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_meds', function (Blueprint $table) {
            $table->id('medicineID');
            $table->unsignedBigInteger('patientID');
            $table->string('dayTime',30);
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_meds');
    }
};
