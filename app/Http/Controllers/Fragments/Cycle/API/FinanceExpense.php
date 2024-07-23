<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FinanceExpense as Expense;
use App\Models\Status;

class FinanceExpense extends Controller
{
    public function __construct()
    {
        $API = Http::get('https://fms2-ecabf.fguardians-fms.com/api/expensesApi');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        // dd($budgetData);
        foreach ($budgetData as $budget) {
            // check if the id is not listed in the database
            if (!Expense::where('id', $budget['id'])->exists()) {
                // dd($budget['id']);
                $approval = new Expense();
                $approval->id = $budget['id'];
                $approval->date = $budget['date'];
                $approval->amount = $budget['amount'];
                $approval->category = $budget['category'];
                $approval->description = $budget['description'];
                $approval->save();
            }
        }
    }

    public function index()
    {
        $data = [
            'budgetData' => Expense::all(),
            'statuses' => Status::all(),
        ];

        return view('board.new.finance.expense', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'budget' => 'required',
            'status' => 'required',

        ]);
        // dd($request->status);
        $request_amount = str_replace("₱", "", $request->budget);
        $convert_amount1 = str_replace(",", "", $request_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        $approval = Expense::find($request->id);

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

        $requests = Expense::where('date', 'like', '%' . $search . '%')
            ->orWhere('id', 'like', '%' . $search . '%')
            ->orWhere('amount', 'like', '%' . $search . '%')
            ->orWhere('category', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('admin_budget', 'like', '%' . $search . '%')
            ->orWhere('admin_status', 'like', '%' . $search . '%')
            ->get();
        $data = [
            'budgetData' => $requests,
        ];

        return view('board.new.finance.expense', $data);
    }
}
