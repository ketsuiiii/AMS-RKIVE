<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetRequest extends Model
{
    use HasFactory;


    protected $table = 'g59_budget_requests';

    protected $fillable = [
        'budget_code',
        'budget_name',
        'budget_amount',
        'budget_justification',
        'budget_period',
        'budget_date',
        'budget_historicalData',
        'budget_riskFactorsAndContingencies',
        'budget_impactOnOperations',
        'budget_alignmentWithObjectives',
        'budget_alternativesConsidered',
        'budget_category',
        'budget_type',
        'budget_optional',
        'budget_department',
        'budget_supportingDocumentation',
        'budget_supportingDocumentationName',
        'budget_assumptionsAndMethodology',
        'budget_status',
        'budget_approvedBy',
        'budget_approvedDate',
        'budget_approvedAmount',
        'budget_notes',

        'budget_createdBy',
        'budget_revisedBy',
        'budget_email',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'budget_category', 'category_code');
    }

    public function type()
    {
        return $this->belongsTo(Types::class, 'budget_type', 'type_code');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'budget_department', 'department_code');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'budget_status', 'status_code');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'budget_approvedBy', 'username');
    }

    public function periods()
    {
        return $this->belongsTo(Period::class, 'budget_period', 'period_code');
    }

    public function optional()
    {
        return $this->belongsTo(Optional::class, 'budget_optional', 'optional_code');
    }

    public function getDepartmentNameAttribute()
    {
        return $this->department ? $this->department->department_name : null;
    }

    public function tracks()
    {
        return $this->hasMany(Track::class, 'id', 'track_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'budget_createdBy', 'username');
    }

    public function revisedBy()
    {
        return $this->belongsTo(User::class, 'budget_revisedBy', 'username');
    }


}
