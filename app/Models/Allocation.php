<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;
    protected $table = "g59_allocation";

    protected $fillable = [
        'allocation_code',
        'allocation_department',
        'allocation_amount',
    ];

    // public function budgetRequest()
    // {
    //     return $this->hasMany(BudgetRequest::class, 'budget_optional', 'optional_code');
    // }

    // public function addBudgetRequest()
    // {
    //     return $this->hasMany(AddBudgetRequest::class, 'request_optional', 'optional_code');
    // }
}
