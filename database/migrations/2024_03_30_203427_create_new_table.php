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
        Schema::create('g59_periods', function (Blueprint $table) {
            $table->id();
            $table->string('periods');
            $table->string('period_code')->unique();
            $table->string('period_name');
            $table->timestamps();

            // Indexes
            $table->index('period_code');
        });

        Schema::create('g59_optional', function (Blueprint $table) {
            $table->id();
            $table->string('optional_code');
            $table->string('optional_name');
            $table->timestamps();

            // Indexes
            $table->index('optional_code');
        });

        Schema::create('g59_budget_requests', function (Blueprint $table) {
            $table->id();

            // Budget Info
            $table->string('budget_code')->unique();
            $table->string('budget_name')->unique();
            $table->string('budget_amount');
            $table->text('budget_justification');

            $table->string('budget_period');
            $table->string('budget_date');

            //optional
            $table->string('budget_optional');
            $table->text('budget_historicalData')->nullable();
            $table->text('budget_riskFactorsAndContingencies')->nullable();
            $table->text('budget_impactOnOperations')->nullable();
            $table->text('budget_alignmentWithObjectives')->nullable();
            $table->text('budget_alternativesConsidered')->nullable();

            $table->string('budget_category');
            $table->string('budget_type');
            $table->string('budget_department');

            // Supporting Documentation
            $table->text('budget_supportingDocumentation')->nullable();
            $table->text('budget_supportingDocumentationName')->nullable();
            $table->text('budget_assumptionsAndMethodology')->nullable();

            // Approval Status
            $table->string('budget_status');
            $table->string('budget_approvedBy', )->nullable();
            $table->date('budget_approvedDate')->nullable();
            $table->string('budget_approvedAmount')->nullable();
            $table->text('budget_notes')->nullable();
            $table->timestamps();

            $table->string('budget_createdBy')->nullable();
            $table->string('budget_revisedBy')->nullable();
            $table->string('budget_email')->nullable();

            // Foreign Keys
            $table->foreign('budget_category')->references('category_code')->on('g59_categories');
            $table->foreign('budget_type')->references('type_code')->on('g59_types');
            $table->foreign('budget_department')->references('department_code')->on('g59_departments');
            $table->foreign('budget_status')->references('status_code')->on('g59_statuses');
            $table->foreign('budget_approvedBy')->references('username')->on('g59_users');
            $table->foreign('budget_period')->references('period_code')->on('g59_periods');
            $table->foreign('budget_optional')->references('optional_code')->on('g59_optional');

        });

        Schema::create('g59_addbudget_requests', function (Blueprint $table) {
            $table->id();

            // Request Info
            $table->string('request_code')->unique();
            $table->string('request_name')->unique();
            $table->string('request_amount');
            $table->string('request_category');
            $table->string('request_type');
            $table->string('request_department');
            $table->string('request_period');
            $table->string('request_date');

            // Variance Info
            $table->string('request_actualSpending');
            $table->text('request_justification');

            $table->unsignedBigInteger('request_projectDetails'); // budgetRequest(ID)
            $table->foreign('request_projectDetails')->references('id')->on('g59_budget_requests')->onDelete('cascade');

            //Optional
            $table->string('request_optional');
            $table->text('request_historicalData')->nullable();
            $table->text('request_riskFactorsAndContingencies')->nullable();
            $table->text('request_impactOnOperations')->nullable();
            $table->text('request_alignmentWithObjectives')->nullable();
            $table->text('request_alternativesConsidered')->nullable();
            $table->text('request_assumptionsAndMethodology')->nullable();

            // Supporting Documentation
            $table->text('request_supportingDocumentation')->nullable();
            $table->text('request_supportingDocumentationName')->nullable();

            // Approval Status
            $table->string('request_status');
            $table->string('request_approvedBy', )->nullable();
            $table->date('request_approvedDate')->nullable();
            $table->string('request_approvedAmount')->nullable();
            $table->text('request_notes')->nullable();
            $table->timestamps();

            $table->string('request_createdBy')->nullable();
            $table->string('request_revisedBy')->nullable();
            $table->string('request_email')->nullable();

            // Foreign Keys
            $table->foreign('request_category')->references('category_code')->on('g59_categories');
            $table->foreign('request_type')->references('type_code')->on('g59_types');
            $table->foreign('request_department')->references('department_code')->on('g59_departments');
            $table->foreign('request_status')->references('status_code')->on('g59_statuses');
            $table->foreign('request_approvedBy')->references('username')->on('g59_users');
            $table->foreign('request_period')->references('period_code')->on('g59_periods');
            $table->foreign('request_optional')->references('optional_code')->on('g59_optional');

        });

        Schema::create('g59_allocation', function (Blueprint $table) {
            $table->id();
            $table->string('allocation_code')->unique();
            $table->string('allocation_department');
            $table->string('allocation_amount');
            $table->timestamps();
        });

        Schema::create('g59_budget_track', function (Blueprint $table) {
            $table->id();

            // Track Info
            $table->unsignedBigInteger('track_id');
            $table->string('track_department');
            $table->string('track_category');
            $table->integer('track_amount');
            $table->date('track_date');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('track_id')->references('id')->on('g59_budget_requests')->onDelete('cascade');
            $table->foreign('track_department')->references('budget_department')->on('g59_budget_requests')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('g59_budget_track');
        Schema::dropIfExists('g59_addbudget_requests');
        Schema::dropIfExists('g59_budget_requests');
        Schema::dropIfExists('g59_allocation');
        Schema::dropIfExists('g59_optional');
        Schema::dropIfExists('g59_periods');
    }
};
