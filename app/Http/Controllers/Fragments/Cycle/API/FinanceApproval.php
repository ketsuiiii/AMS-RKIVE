<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\FinanceApproval as Approval;
use Illuminate\Support\Facades\Http;

class FinanceApproval extends Controller
{
    public function __construct()
    {
        $API = Http::get('https://fms3-swasfcrb.fguardians-fms.com/s-pull-admin-xd-approved');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        // dd($budgetData);
        foreach ($budgetData as $budget) {
            // check if the id is not listed in the database
            if (!Approval::where('id', $budget['id'])->exists()) {
                // dd($budget['id']);
                $approval = new Approval();
                $approval->title = $budget['title'];
                $approval->budget = $budget['budget'];
                $approval->description = $budget['description'];
                $approval->submitted_at = $budget['submitted_at'];
                $approval->reference = $budget['reference'];
                $approval->submitted_by = $budget['submitted_by'];
                $approval->admin_status = $budget['admin_status'];
                $approval->status = $budget['status'];
                $approval->save();
            }
        }
    }

    public function index()
    {
        $data = [
            'budgetData' => Approval::all(),
            'statuses' => Status::all(),
        ];

        return view('board.new.finance.approval', $data);
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

        $approval = Approval::find($request->id);

        if ($request->status == 'pending') {
            return redirect()->back()->with('error_message', 'Budget not updated. Please select a valid status.');
        } else {
            $approval->update([
                'budget' => $convert_amount,
                'admin_status' => $request->status,
            ]);

            return redirect()->back()->with('success', 'Budget updated successfully.');
        }

    }

    public function search(Request $request)
    {
        $search = $request->search;

        $requests = Approval::where('title', 'like', '%' . $search . '%')
            ->orWhere('id', 'like', '%' . $search . '%')
            ->orWhere('budget', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('reference', 'like', '%' . $search . '%')
            ->orWhere('submitted_at', 'like', '%' . $search . '%')
            ->orWhere('submitted_by', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->orWhere('admin_status', 'like', '%' . $search . '%')
            ->get();

        $data = [
            'budgetData' => $requests,
        ];

        return view('board.new.finance.approval', $data);
    }
}
