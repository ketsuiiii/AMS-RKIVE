<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FinancePayment as Payment;
use App\Models\Status;

class FinancePayment extends Controller
{
    public function __construct()
    {
        $API = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        // dd($budgetData);
        foreach ($budgetData as $budget) {
            // check if the id is not listed in the database
            if (!Payment::where('id', $budget['id'])->exists()) {
                // dd($budget['id']);
                $approval = new Payment();
                $approval->id = $budget['id'];
                $approval->reference = $budget['reference'];
                $approval->productName = $budget['productName'];
                $approval->transactionName = $budget['transactionName'];
                $approval->transactionDate = $budget['transactionDate'];
                $approval->cardType = $budget['cardType'];
                $approval->transactionType = $budget['transactionType'];
                $approval->transactionAmount = $budget['transactionAmount'];
                $approval->description = $budget['description'];
                $approval->transactionStatus = $budget['transactionStatus'];
                $approval->reasonForCancellation = $budget['reasonForCancellation'];
                $approval->comment = $budget['comment'];
                $approval->save();
            }
        }
    }

    public function index()
    {
        $data = [
            'budgetData' => Payment::all(),
            'statuses' => Status::all(),
        ];

        return view('board.new.finance.payment', $data);
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

        $approval = Payment::find($request->id);

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

        $requests = Payment::where('reference', 'like', '%' . $search . '%')
            ->orWhere('id', 'like', '%' . $search . '%')
            ->orWhere('productName', 'like', '%' . $search . '%')
            ->orWhere('transactionName', 'like', '%' . $search . '%')
            ->orWhere('cardType', 'like', '%' . $search . '%')
            ->orWhere('transactionType', 'like', '%' . $search . '%')
            ->orWhere('transactionAmount', 'like', '%' . $search . '%')
            ->orWhere('transactionStatus', 'like', '%' . $search . '%')
            ->orWhere('reasonForCancellation', 'like', '%' . $search . '%')
            ->orWhere('comment', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('admin_budget', 'like', '%' . $search . '%')
            ->orWhere('admin_status', 'like', '%' . $search . '%')
            ->get();
        $data = [
            'budgetData' => $requests,
        ];

        return view('board.new.finance.payment', $data);
    }
}
