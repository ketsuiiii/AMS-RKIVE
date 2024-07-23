<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelsExpenses extends Model
{
    use HasFactory;
    protected $table = 'g59_travel_expense_reports';
    protected $primaryKey = 'ReportID';
    public function reports()
    {
        return $this->belongsTo(Travels::class, 'RequestID'); // Specify the foreign key
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID'); // Specify the foreign key
    }
}
