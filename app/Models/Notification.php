<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'g59_notification';
    protected $fillable = [
        'status',
        'title', // Your budget request has been approved/rejected by your Admin.
        'content', // notes
        'from', // Admin name
        'to', // User department
        'reference', // budget id (direct to search)
        'type'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status', 'status_code');
    }

    public function type()
    {
        return $this->belongsTo(Types::class, 'type', 'type_code');
    }

}
