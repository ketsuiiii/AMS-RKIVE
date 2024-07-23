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
        Schema::create('g59_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('status');
            $table->text('message');
            $table->string('url');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('username')->on('g59_users');

            // Indexes
            $table->index('user_id');
            $table->index('url');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g59_logs');
    }
};
