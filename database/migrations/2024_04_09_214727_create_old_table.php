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
        Schema::create('g59_budgets', function (Blueprint $table) {
            $table->id();  // This creates an auto-incrementing primary key named 'id'

            // Budget Info
            $table->string('budget_name')->unique();
            $table->integer('budget_amount');
            $table->text('budget_description');
            $table->date('budget_startDate');
            $table->date('budget_endDate');

            $table->string('budget_category');
            $table->string('budget_type');
            $table->string('budget_department');

            // Approval Status
            $table->string('budget_status')->default('S2');
            $table->string('budget_approvedBy', )->nullable();
            $table->date('budget_approvedDate')->nullable();
            $table->integer('budget_approvedAmount')->nullable();
            $table->text('budget_notes')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('budget_category')->references('category_code')->on('g59_categories');
            $table->foreign('budget_type')->references('type_code')->on('g59_types');
            $table->foreign('budget_department')->references('department_code')->on('g59_departments');
            $table->foreign('budget_status')->references('status_code')->on('g59_statuses');
            $table->foreign('budget_approvedBy')->references('username')->on('g59_users');
        });

        Schema::create('g59_add_budgets_request', function (Blueprint $table) {
            $table->id();

            // Request Info
            $table->string('request_name')->unique();
            $table->integer('request_amount');
            $table->text('request_description');

            $table->string('request_category');
            $table->string('request_type');
            $table->string('request_department');
            $table->unsignedBigInteger('request_budget_code');
            $table->foreign('request_budget_code')->references('id')->on('g59_budgets')->onDelete('cascade');
            // $table->foreign('request_budget_code')->references('id')->on('g59_budgets');

            // Variance Info
            $table->integer('request_actualSpending');
            $table->integer('request_variance');
            $table->text('request_varianceReason');

            // Approval Status
            $table->string('request_status')->default('S2');
            $table->string('request_approvedBy', )->nullable();
            $table->date('request_approvedDate')->nullable();
            $table->integer('request_approvedAmount')->nullable();
            $table->text('request_notes')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('request_category')->references('category_code')->on('g59_categories');
            $table->foreign('request_type')->references('type_code')->on('g59_types');
            $table->foreign('request_department')->references('department_code')->on('g59_departments');
            $table->foreign('request_status')->references('status_code')->on('g59_statuses');
            $table->foreign('request_approvedBy')->references('username')->on('g59_users');

        });

        Schema::create('g59_cashflow_statement', function (Blueprint $table) {
            $table->id();

            // Cashflow Info
            $table->string('cashflow_info');
            $table->string('cashflow_name');
            $table->integer('cashflow_amount');
            $table->date('cashflow_date');

            $table->string('cashflow_type');
            $table->string('cashflow_department');
            $table->string('cashflow_category');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('cashflow_type')->references('type_code')->on('g59_types');
            $table->foreign('cashflow_department')->references('department_code')->on('g59_departments');
            $table->foreign('cashflow_category')->references('plan_category_code')->on('g59_plan_categories');

            // Indexes
            $table->index('cashflow_info');
        });

        Schema::create('g59_income_statement', function (Blueprint $table) {
            $table->id();

            // Income Info
            $table->string('income_info');
            $table->string('income_name');
            $table->integer('income_amount');
            $table->date('income_date');

            $table->string('income_type');
            $table->string('income_department');
            $table->string('income_category');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('income_department')->references('department_code')->on('g59_departments');
            $table->foreign('income_category')->references('plan_category_code')->on('g59_plan_categories');
            $table->foreign('income_type')->references('type_code')->on('g59_types');

            // Indexes
            $table->index('income_info');
        });

        Schema::create('g59_balance_sheet', function (Blueprint $table) {
            $table->id();

            // Balance Info
            $table->string('balance_info');
            $table->string('balance_name');
            $table->integer('balance_amount');
            $table->date('balance_date');

            $table->string('balance_type');
            $table->string('balance_department');
            $table->string('balance_category');
            $table->timestamps();

            // Foreign Key
            $table->foreign('balance_type')->references('type_code')->on('g59_types');
            $table->foreign('balance_department')->references('department_code')->on('g59_departments');
            $table->foreign('balance_category')->references('plan_category_code')->on('g59_plan_categories');

            // Indexes
            $table->index('balance_info');
        });

        Schema::create('g59_accounts_payable', function (Blueprint $table) {
            $table->id();

            // Payable Info
            $table->string('payable_info');
            $table->string('payable_name');
            $table->integer('payable_amount');
            $table->date('payable_date');

            $table->string('payable_type');
            $table->string('payable_department');
            $table->string('payable_category');
            $table->timestamps();

            // Foreign Key
            $table->foreign('payable_type')->references('type_code')->on('g59_types');
            $table->foreign('payable_department')->references('department_code')->on('g59_departments');
            $table->foreign('payable_category')->references('plan_category_code')->on('g59_plan_categories');

            // Indexes
            $table->index('payable_info');
        });

        Schema::create('g59_accounts_recievable', function (Blueprint $table) {
            $table->id();

            // Recievable Info
            $table->string('recievable_info');
            $table->string('recievable_name');
            $table->date('recievable_invoice_date');
            $table->integer('recievable_amount');
            $table->integer('recievable_due_date');

            $table->string('recievable_type');
            $table->string('recievable_department');
            $table->string('recievable_category');
            $table->timestamps();

            //Foreign Key
            $table->foreign('recievable_type')->references('type_code')->on('g59_types');
            $table->foreign('recievable_department')->references('department_code')->on('g59_departments');
            $table->foreign('recievable_category')->references('plan_category_code')->on('g59_plan_categories');

            //Indexes
            $table->index('recievable_info');
        });

        Schema::create('g59_inventory_turnover', function (Blueprint $table) {
            $table->id();

            // Turnover Info
            $table->string('turnover_info');
            $table->string('turnover_product_name');
            $table->string('turnover_cost_of_goods_sold');
            $table->string('turnover_inventory_turnover_ratio');
            $table->date('turnover_date');

            $table->string('turnover_type');
            $table->string('turnover_department');
            $table->string('turnover_category');
            $table->timestamps();

            //Foreign Key
            $table->foreign('turnover_type')->references('type_code')->on('g59_types');
            $table->foreign('turnover_department')->references('department_code')->on('g59_departments');
            $table->foreign('turnover_category')->references('plan_category_code')->on('g59_plan_categories');

            //Indexes
            $table->index('turnover_info');
        });

        Schema::create('g59_sales_report', function (Blueprint $table) {
            $table->id();

            // Sales Info
            $table->string('sales_info');
            $table->string('sales_product_name');
            $table->string('sales_revenue');
            $table->date('sales_date');

            $table->string('sales_type');
            $table->string('sales_department');
            $table->string('sales_category');
            $table->timestamps();

            // Foreign Key
            $table->foreign('sales_type')->references('type_code')->on('g59_types');
            $table->foreign('sales_department')->references('department_code')->on('g59_departments');
            $table->foreign('sales_category')->references('plan_category_code')->on('g59_plan_categories');

            // Indexes
            $table->index('sales_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g59_sales_report');
        Schema::dropIfExists('g59_inventory_turnover');
        Schema::dropIfExists('g59_accounts_recievable');
        Schema::dropIfExists('g59_accounts_payable');
        Schema::dropIfExists('g59_balance_sheet');
        Schema::dropIfExists('g59_income_statement');
        Schema::dropIfExists('g59_cashflow_statement');
        Schema::dropIfExists('g59_add_budgets_request');
        Schema::dropIfExists('g59_budgets');
    }
};
