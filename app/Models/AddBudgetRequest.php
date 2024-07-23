<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBudgetRequest extends Model
{
    use HasFactory;

    protected $table = 'g59_addbudget_requests';

    protected $fillable = [
        'request_name',
        'request_code',
        'request_amount',
        'request_category',
        'request_type',
        'request_department',
        'request_actualSpending',
        'request_justification',
        'request_period',
        'request_date',
        'request_optional',
        'request_projectDetails',
        'request_historicalData',
        'request_riskFactorsAndContingencies',
        'request_impactOnOperations',
        'request_alignmentWithObjectives',
        'request_alternativesConsidered',
        'request_supportingDocumentation',
        'request_supportingDocumentationName',
        'request_assumptionsAndMethodology',
        'request_status',
        'request_approvedBy',
        'request_approvedDate',
        'request_approvedAmount',
        'request_notes',

        'request_createdBy',
        'request_revisedBy',
        'request_email',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'request_category', 'category_code');
    }

    public function type()
    {
        return $this->belongsTo(Types::class, 'request_type', 'type_code');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'request_department', 'department_code');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'request_status', 'status_code');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'request_approvedBy', 'username');
    }
    public function budget()
    {
        return $this->belongsTo(BudgetRequest::class, 'request_projectDetails', 'id');
    }

    public function periods()
    {
        return $this->belongsTo(Period::class, 'request_period', 'period_code');
    }

    public function optional()
    {
        return $this->belongsTo(Optional::class, 'request_optional', 'optional_code');
    }

    public function getDepartmentNameAttribute()
    {
        return $this->department ? $this->department->department_name : null;
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'request_createdBy', 'username');
    }

    public function revisedBy()
    {
        return $this->belongsTo(User::class, 'request_revisedBy', 'username');
    }
}
