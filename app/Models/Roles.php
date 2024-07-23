<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'g59_roles';

     protected $fillable = [
        'role_name',
        'role_code',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_code', 'role_code');
    }

}
