<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceExpense extends Model
{
    use HasFactory;

    protected $table = 'g59_financeexpense';

    protected $fillable = [
        'date',
        'amount',
        'category',
        'description',
        'admin_budget',
        'admin_status'
    ];
}
