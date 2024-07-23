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
        Schema::create('g59_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('userpassword');
            $table->string('role_code');
            $table->string('department_code');
            $table->string('profile');
            $table->rememberToken();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('role_code')->references('role_code')->on('g59_roles');
            $table->foreign('department_code')->references('department_code')->on('g59_departments');

            // Indexes
            $table->index('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g59_users');
    }
};
