<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('g59_financeApproval', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('budget');
            $table->string('description');
            $table->string('submitted_at');
            $table->string('reference')->nullable();
            $table->string('submitted_by');
            $table->string('admin_status');
            $table->string('status');
            $table->string('comment')->nullable();
            $table->timestamps();

        });

        Schema::create('g59_financeCost', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('cost_center');
            $table->string('cost_category');
            $table->string('cost_type');
            $table->string('amount');
            $table->string('description');
            $table->string('admin_budget')->nullable();
            $table->string('admin_status')->nullable();
            $table->timestamps();

        });

        Schema::create('g59_financePayment', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('productName');
            $table->string('transactionName');
            $table->string('cardType');
            $table->string('transactionType');
            $table->string('transactionDate')->nullable();
            $table->string('transactionAmount');
            $table->string('transactionStatus');
            $table->string('description')->nullable();
            $table->string('reasonForCancellation')->nullable();
            $table->string('comment')->nullable();
            $table->string('admin_budget')->nullable();
            $table->string('admin_status')->nullable();
            $table->timestamps();

        });

        Schema::create('g59_financeExpense', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('amount');
            $table->string('category');
            $table->string('description');
            $table->string('admin_budget')->nullable();
            $table->string('admin_status')->nullable();
            $table->timestamps();

        });

        Schema::create('g59_financeBudget', function (Blueprint $table) {
            $table->id() ;
            $table->string('reference');
            $table->string('title');
            $table->string('description');
            $table->string('amount');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('status');
            $table->string('comment')->nullable();
            $table->string('name');
            $table->string('admin_budget')->nullable();
            $table->string('admin_status')->nullable();
            $table->timestamps();

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g59_financeBudget');
        Schema::dropIfExists('g59_financeExpense');
        Schema::dropIfExists('g59_financePayment');
        Schema::dropIfExists('g59_financeCost');
        Schema::dropIfExists('g59_financeApproval');
    }
};
