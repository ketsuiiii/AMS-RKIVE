<?php

namespace App\Http\Controllers\Fragments\Cycle;

use App\Http\Controllers\Controller;
use App\Models\AddBudgetRequest;
use App\Models\Allocation;
use App\Models\Department;
use Illuminate\Http\Request;

use App\Models\BudgetRequest;
use App\Models\Categories;
use App\Models\Status;
use App\Models\Track;
use Illuminate\Support\Facades\Validator;

class BdgtTrack extends Controller
{

    public function index()
    {
        $allocate = Allocation::all()->sum('allocation_amount');
        $budgetPlan = BudgetRequest::where('budget_status', 'S1')->get();
        $planTrack = Track::all()->sum('track_amount');

        $remaining = $allocate - $planTrack;
        $spend = $allocate - $remaining;

        $data = [];
        foreach ($budgetPlan as $item) {

            $expenses = Track::where('track_id', $item->id)->get()->sum('track_amount');
            $expenseSum = $expenses;

            $data[] = [
                'budget' => $item,
                'department' => $item->budget_department,
                'expenses' => $expenseSum,
                'remain' => $item->budget_approvedAmount - $expenseSum
            ];
        }

        $data1 = [
            'status' => Status::all(),
            'remaining' => $remaining,
            'allocate' => $allocate,
            'spend' => $spend,
            'departments' => Department::all(),
            'budgetPlan' => $budgetPlan,
            // 'expenses' => $data,
        ];
        return view('board.new.tracking.track', compact('data'), $data1);
    }

    public function create($id)
    {
        $budget = BudgetRequest::where('id', $id)->get();
        $categories = Categories::all();
        $expenses = Track::where('track_id', $id)->get();
        $expenseSum = $expenses->sum('track_amount');

        $data = [
            'budget' => $budget,
            'categories' => $categories,
            'expenses' => $expenses,
            'expenseSum' => $expenseSum
        ];

        return view('board.new.tracking.viewbudgets', $data);
    }

    public function saveBudgetExpense(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'track_category' => 'required',
            'track_amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $track_amount = str_replace("₱", "", $request->track_amount);
        $convert_amount1 = str_replace(",", "", $track_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        $budget = BudgetRequest::where('id', $request->track_id)->get();
        $track = Track::where('track_id', $request->track_id)->get();

        $budgetSum = $budget->sum('budget_approvedAmount');
        $trackSum = $track->sum('track_amount');
        $remaining = $budgetSum - $trackSum;

        if ($remaining < $convert_amount) {
            $remaining_formatted = number_format($remaining, 2);
            $convert_amount_formatted = number_format($convert_amount, 2);
            $error_message = "Insufficient budget amount. Remaining budget for this plan is PHP {$remaining_formatted}. Requested amount is PHP {$convert_amount_formatted}.";

            return redirect()->back()->withInput()->with('error_message', $error_message);
        }

        Track::create([
            'track_id' => $request->track_id,
            'track_department' => $request->track_department,
            'track_category' => $request->track_category,
            'track_amount' => $convert_amount,
            'track_date' => $request->track_date,
        ]);

        return redirect()->back()->with('success', 'Expense added successfully');
    }

}


