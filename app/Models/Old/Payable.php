<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Types;
use App\Models\Department;
use App\Models\PlanCategories;

class Payable extends Model
{
    use HasFactory;

    protected $table = 'g59_accounts_payable';

    protected $fillable = [
        'payable_info',
        'payable_name',
        'payable_amount',
        'payable_date',
        'payable_type',
        'payable_department',
        'payable_category',
    ];

    protected $dates = ['payable_date'];

    public function type()
    {
        return $this->belongsTo(Types::class, 'payable_type', 'type_code');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'payable_department', 'department_code');
    }

    public function category()
    {
        return $this->belongsTo(PlanCategories::class, 'payable_category', 'plan_category_code');
    }
}
