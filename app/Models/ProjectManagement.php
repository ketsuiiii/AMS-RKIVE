<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectManagement extends Model
{
    use HasFactory;

    protected $table = 'g57_send_requests';

    protected $fillable = [
        'budgeting_financial',
        // 'is_confirm'
    ];


}
