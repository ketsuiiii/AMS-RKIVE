<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Types;
use App\Models\Department;
use App\Models\PlanCategories;

class Cashflow extends Model
{
    use HasFactory;

    protected $table = 'g59_cashflow_statement';

    protected $fillable = [
        'cashflow_info',
        'cashflow_name',
        'cashflow_amount',
        'cashflow_date',
        'cashflow_type',
        'cashflow_department',
        'cashflow_category',
    ];

    protected $dates = ['cashflow_date'];

    public function type()
    {
        return $this->belongsTo(Types::class, 'cashflow_type', 'type_code');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'cashflow_department', 'department_code');
    }

    public function category()
    {
        return $this->belongsTo(PlanCategories::class, 'cashflow_category', 'plan_category_code');
    }
}
