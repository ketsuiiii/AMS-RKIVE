<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Types;
use App\Models\Department;
use App\Models\PlanCategories;

class Turnover extends Model
{
    use HasFactory;

    protected $table = 'g59_inventory_turnover';

    protected $fillable = [
        'turnover_info',
        'turnover_product_name',
        'turnover_cost_of_goods_sold',
        'turnover_inventory_turnover_ratio',
        'turnover_date',
        'turnover_type',
        'turnover_department',
        'turnover_category',
    ];

    protected $dates = ['turnover_date'];

    public function type()
    {
        return $this->belongsTo(Types::class, 'turnover_type', 'type_code');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'turnover_department', 'department_code');
    }

    public function category()
    {
        return $this->belongsTo(PlanCategories::class, 'turnover_category', 'plan_category_code');
    }
}
