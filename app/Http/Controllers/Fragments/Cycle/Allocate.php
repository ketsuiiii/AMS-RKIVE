<?php

namespace App\Http\Controllers\Fragments\Cycle;

use App\Http\Controllers\Controller;
use App\Models\Allocation;
use App\Models\Department;
use App\Models\Track;
use App\Models\BudgetRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Allocate extends Controller
{
    public function index()
    {
        $departments = Department::pluck('department_code', 'department_name');
        $data = [];
        foreach ($departments as $department_name => $department_code) {
            $allocate = Allocation::where('allocation_department', $department_code)->sum('allocation_amount');
            $budget = BudgetRequest::where('budget_department', $department_code)->sum('budget_approvedAmount');
            $track = Track::where('track_department', $department_code)->sum('track_amount');
            $remaining = $allocate - $budget;
            $remainingBudget = $budget - $track;
            $data[] = [
                'department_name' => $department_name,
                'department_code' => $department_code,
                'allocate' => $allocate,
                'track' => $track,
                'remaining' => $remaining,
                'remainingBudget' => $remainingBudget
            ];

        }

        $departments = Department::all();
        return view('board.new.allocation.index', compact('data', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'allocation_amount' => 'required',

        ]);

        $allocation_amount = str_replace("₱", "", $request->allocation_amount);

        $convert_amount1 = str_replace(",", "", $allocation_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        if ($request->allocation_type == 'Y') {
            Allocation::create([
                'allocation_department' => $request->allocation_department,
                'allocation_code' => Str::uuid(),
                'allocation_amount' => $convert_amount,
            ]);
            return back()->with('success', 'Allocation per department created successfully');
        }

        $department = Department::pluck('department_code');
        $departmentCount = count($department);

        $allocate = $convert_amount / $departmentCount;

        foreach ($department as $dept) {
            Allocation::create([
                'allocation_department' => $dept,
                'allocation_code' => Str::uuid(),
                'allocation_amount' => $allocate,
            ]);
        }

        return back()->with('success', 'Allocation created successfully');
    }

    public function viewAllocation($id)
    {
        $allocate = Allocation::where('allocation_department', $id)->sum('allocation_amount');
        $track = Track::where('track_department', $id)->sum('track_amount');
        $remaining = $allocate - $track;

        $department = Department::where('department_code', $id)->first();
        $department_name = $department->department_name;

        $breakdown = Track::where('track_department', $id)->get();
        $data = [
            'allocate' => $allocate,
            'track' => $track,
            'remaining' => $remaining,
            'department' => $department_name,
            'breakdown' => $breakdown
        ];

        return view('board.new.allocation.view', $data);
    }


}
