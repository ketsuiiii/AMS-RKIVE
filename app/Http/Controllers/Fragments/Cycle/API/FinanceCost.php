<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\FinanceCost as Cost;
use Illuminate\Support\Facades\Http;

class FinanceCost extends Controller
{
    public function __construct()
    {
        $API = Http::get('https://fms2-ecabf.fguardians-fms.com/api/costApi');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        // dd($budgetData);
        foreach ($budgetData as $budget) {
            // check if the id is not listed in the database
            if (!Cost::where('id', $budget['id'])->exists()) {
                // dd($budget['id']);
                $approval = new Cost();
                $approval->id = $budget['id'];
                $approval->item = $budget['item'];
                $approval->cost_center = $budget['cost_center'];
                $approval->cost_category = $budget['cost_category'];
                $approval->cost_type = $budget['cost_type'];
                $approval->amount = $budget['amount'];
                $approval->description = $budget['description'];
                $approval->save();
            }
        }
    }

    public function index()
    {
        $data = [
            'budgetData' => Cost::all(),
            'statuses' => Status::all(),
        ];

        return view('board.new.finance.cost', $data);
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

        $approval = Cost::find($request->id);

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

        $requests = Cost::where('item', 'like', '%' . $search . '%')
            ->orWhere('id', 'like', '%' . $search . '%')
            ->orWhere('cost_center', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('cost_category', 'like', '%' . $search . '%')
            ->orWhere('cost_type', 'like', '%' . $search . '%')
            ->orWhere('amount', 'like', '%' . $search . '%')
            ->orWhere('admin_budget', 'like', '%' . $search . '%')
            ->orWhere('admin_status', 'like', '%' . $search . '%')
            ->get();
        $data = [
            'budgetData' => $requests,
        ];

        return view('board.new.finance.cost', $data);
    }
}
