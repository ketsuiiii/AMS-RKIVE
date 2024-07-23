<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optional extends Model
{
    use HasFactory;
    protected $table = "g59_optional";

    protected $fillable = [
        'optional_code',
        'optional_name',
    ];

    public function budgetRequest()
    {
        return $this->hasMany(BudgetRequest::class, 'budget_optional', 'optional_code');
    }

    public function addBudgetRequest()
    {
        return $this->hasMany(AddBudgetRequest::class, 'request_optional', 'optional_code');
    }
}

