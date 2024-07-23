<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancePayment extends Model
{
    use HasFactory;

    protected $table = 'g59_financepayment';

    protected $fillable = [
        'reference',
        'productName',
        'transactionName',
        'cardType',
        'transactionDate',
        'transactionType',
        'transactionAmount',
        'transactionStatus',
        'reasonForCancellation',
        'comment',
        'description',
        'admin_budget',
        'admin_status',
    ];

}
