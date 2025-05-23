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
         Schema::create('passwords', function (Blueprint $table) {
            $table->id('passwordID');
            $table->unsignedBigInteger('individualID');
            $table->string('password', 255);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('passwords');
    }
};
