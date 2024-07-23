<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceApproval extends Model
{
    use HasFactory;

    protected $table = 'g59_financeapproval';
    protected $fillable = [
        'title',
        'budget',
        'description',
        'submitted_at',
        'reference',
        'submitted_by',
        'admin_status',
        'status',
        'comment',
    ];

}
