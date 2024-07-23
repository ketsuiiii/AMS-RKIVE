<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceCost extends Model
{
    use HasFactory;
    protected $table = 'g59_financecost';

    protected $fillable = [
        'item',
        'cost_center',
        'cost_category',
        'cost_type',
        'amount',
        'description',
        'admin_budget',
        'admin_status',
    ];
}
