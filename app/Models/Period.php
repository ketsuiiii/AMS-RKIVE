<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = "g59_periods";

    protected $fillable = [
        'period_code',
        'period_name',
        'periods',
    ];

    public function budgetRequest()
    {
        return $this->hasMany(BudgetRequest::class, 'budget_period', 'period_code');
    }

    public function addBudgetRequest()
    {
        return $this->hasMany(AddBudgetRequest::class, 'request_period', 'period_code');
    }
}

