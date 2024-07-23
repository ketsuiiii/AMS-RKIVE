<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Types;
use App\Models\Department;
use App\Models\Categories;
use App\Models\Status;
use App\Models\Old\Budget;
use App\Models\User;

class AddBudgets extends Model
{
    use HasFactory;

    protected $table = 'g59_add_budgets_request';

    protected $fillable = [
        'request_name',
        'request_amount',
        'request_description',
        'request_category',
        'request_type',
        'request_department',
        'request_budget_code',
        'request_actualSpending',
        'request_variance',
        'request_varianceReason',
        'request_status',
        'request_approvedBy',
        'request_approvedDate',
        'request_approvedAmount',
        'request_notes',
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
        return $this->belongsTo(Budget::class, 'request_budget_code', 'id');
    }
}
