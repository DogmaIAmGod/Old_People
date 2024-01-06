<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cares', function (Blueprint $table) {
            $table->id('careID');
            $table->unsignedBigInteger('caregiverID');
            $table->unsignedBigInteger('patientID');
            $table->date('careDate');
            $table->string('breakfast', 1)->nullable();
            $table->string('lunch', 1)->nullable();
            $table->string('dinner', 1)->nullable();
            $table->string('moringMeds',1)->nullable();
            $table->string('lunchMeds',1)->nullable();
            $table->string('dinnerMeds',1)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cares');
    }
};
