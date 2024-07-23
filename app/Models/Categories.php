<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'g59_categories';

    protected $fillable = [
        'category_name',
    ];

    public function budgets(){

        return $this->hasMany(Budget::class, 'budget_category', 'category_code');
    }

    public function addBudgets(){

        return $this->hasMany(AddBudgets::class, 'add_budget_category', 'category_code');
    }

}
