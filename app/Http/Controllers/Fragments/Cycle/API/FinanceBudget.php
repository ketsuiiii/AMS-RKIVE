<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FinanceBudget as Budget;
use App\Models\Status;

class FinanceBudget extends Controller
{
    public function __construct()
    {
        $API = Http::get('https://fms2-ecabf.fguardians-fms.com/api/budgetApi');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        // dd($budgetData);
        foreach ($budgetData as $budget) {
            // check if the id is not listed in the database
            if (!Budget::where('reference', $budget['reference'])->exists()) {
                // dd($budget['id']);
                $approval = new Budget();
                $approval->reference = $budget['reference'];
                $approval->title = $budget['title'];
                $approval->description = $budget['description'];
                $approval->amount = $budget['amount'];
                $approval->start_date = $budget['start_date'];
                $approval->end_date = $budget['end_date'];
                $approval->status = $budget['status'];
                $approval->comment = $budget['comment'];
                $approval->name = $budget['name'];
                $approval->save();
            }
        }
    }

    public function index()
    {
        $data = [
            'budgetData' => Budget::all(),
            'statuses' => Status::all(),
        ];

        return view('board.new.finance.budget', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'budget' => 'required',
            'status' => 'required',

        ]);

        $request_amount = str_replace("₱", "", $request->budget);
        $convert_amount1 = str_replace(",", "", $request_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'
        $approval = Budget::find($request->id);

        if ($request->status == 'pending') {
            return redirect()->back()->with('error_message', 'Budget not updated. Please select a valid status.');
        } else {
            $approval->update([
                'admin_budget' => $convert_amount,
                'admin_status' => $request->status,
            ]);

            return redirect()->back()->with('success', 'Budget updated successfully.');
        }

    }

    public function search(Request $request)
    {
        $search = $request->search;

        $requests = Budget::where('title', 'like', '%' . $search . '%')
            ->orWhere('id', 'like', '%' . $search . '%')
            ->orWhere('reference', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('start_date', 'like', '%' . $search . '%')
            ->orWhere('end_date', 'like', '%' . $search . '%')
            ->orWhere('amount', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->orWhere('comment', 'like', '%' . $search . '%')
            ->orWhere('admin_budget', 'like', '%' . $search . '%')
            ->orWhere('admin_status', 'like', '%' . $search . '%')
            ->get();
        $data = [
            'budgetData' => $requests,
        ];

        return view('board.new.finance.budget', $data);
    }
}
