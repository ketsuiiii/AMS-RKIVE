<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Old\Budget;
use App\Models\Old\AddBudgets;

class Status extends Model
{
    use HasFactory;

    protected $table = 'g59_statuses';

    protected $fillable = [
        'status_name',
    ];

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'budget_status', 'status_code');
    }

    public function addBudget()
    {
        return $this->hasMany(AddBudgets::class, 'request_status', 'status_code');
    }

}
