<?php

namespace App\Http\Controllers\Fragments\Cycle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BudgetRequest;
use App\Models\Categories;
use App\Models\Track;
use App\Models\Department;

class Reporting extends Controller
{

    public function index($id)
    {
        $budget = BudgetRequest::where('id', $id)->get();
        $categories = Categories::all();
        $expenses = Track::where('track_id', $id)->get();
        $expenseSum = $expenses->sum('track_amount');
        $department = Department::all();

        $data = [
            'budget' => $budget,
            'categories' => $categories,
            'expenses' => $expenses,
            'expenseSum' => $expenseSum,
            'filename' => $budget[0]->budget_name,
            'department' => $department
        ];

        return view('board.new.reporting.index', $data);
    }
}
