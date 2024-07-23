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
        Schema::create('g59_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code')->unique();
            $table->string('category_name')->unique();
            $table->string('category_other')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('category_code');
        });

        Schema::create('g59_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_code')->unique();
            $table->string('type_name')->unique();
            $table->timestamps();

            // Indexes
            $table->index('type_code');
        });

        Schema::create('g59_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_code')->unique();
            $table->string('status_name')->unique();
            $table->timestamps();

            // Indexes
            $table->index('status_code');
        });

        Schema::create('g59_plan_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_type');
            $table->string('plan_category_code')->unique();
            $table->string('plan_category_name');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('category_type')->references('type_code')->on('g59_types');

            // Indexes
            $table->index('plan_category_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g59_plan_categories');
        Schema::dropIfExists('g59_statuses');
        Schema::dropIfExists('g59_types');
        Schema::dropIfExists('g59_categories');
    }
};
