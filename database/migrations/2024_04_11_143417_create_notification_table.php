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
        Schema::create('g59_notification', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('title');
            $table->text('content');
            $table->string('from');
            $table->string('to');
            $table->string('reference');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g59_notification');
    }
};
