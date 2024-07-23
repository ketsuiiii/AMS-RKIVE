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
        Schema::create('g59_departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_code')->unique();
            $table->string('department_name')->unique();
            $table->timestamps();

            // Indexes
            $table->index('department_code');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g59_departments');
    }
};
