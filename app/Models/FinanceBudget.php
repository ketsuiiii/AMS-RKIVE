<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceBudget extends Model
{
    use HasFactory;

    protected $table = 'g59_financebudget';

    protected $fillable = [
        'reference',
        'title',
        'description',
        'amount',
        'start_date',
        'end_date',
        'status',
        'comment',
        'name',
        'admin_budget',
        'admin_status',
    ];
}
