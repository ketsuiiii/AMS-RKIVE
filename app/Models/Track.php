<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = 'g59_budget_track';

    protected $fillable = [
        'track_id',
        'track_date',
        'track_category',
        'track_department',
        'track_amount'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'track_category', 'category_code');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'track_department', 'department_code');
    }

}
