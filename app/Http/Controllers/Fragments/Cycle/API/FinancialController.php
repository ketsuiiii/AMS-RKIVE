<?php
namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;


class FinancialController extends Controller
{
    public function budget()
    {
        $API = Http::get('https://fms2-ecabf.fguardians-fms.com/api/budgetApi');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        $data = [
            'budgetData' => $budgetData,
            'statuses' => Status::all(),
        ];

        // Pass the decoded JSON data to the view
        return view('board.new.finance.budget', $data);
    }

    public function budgetUpdate(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'budget' => 'required',
            'comment' => 'required',
            'status' => 'required',
        ]);

        // Convert the amount from the format "₱123,456.78" to "123456.78"
        $request_amount = str_replace("₱", "", $request->budget);
        $convert_amount1 = str_replace(",", "", $request_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        // Create an array of the request data
        $data = array(
            'budget' => $convert_amount,
            'comment' => $request->comment,
            'status' => $request->status,
        );

        // Perform the API request to update the budget data
        $response = Http::post("https://fms2-ecabf.fguardians-fms.com/api/budgetApi/{$id}", $data);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect back to index with success message
            return redirect()->back()->with('success', 'Budget updated successfully.');
        } else {
            // If request fails, redirect back with error message
            return redirect()->back()->with('error', 'Failed to update budget. Please try again.');
        }
    }

    public function payment()
    {
        $API = Http::get('https://fms5-iasipgcc.fguardians-fms.com/payment');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        $data = [
            'budgetData' => $budgetData,
            'statuses' => Status::all(),
        ];

        // Pass the decoded JSON data to the view
        return view('board.new.finance.payment', $data);
    }

    public function paymentUpdate(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'budget' => 'required',
            'comment' => 'required',
            'status' => 'required',
        ]);

        // Convert the amount from the format "₱123,456.78" to "123456.78"
        $request_amount = str_replace("₱", "", $request->budget);
        $convert_amount1 = str_replace(",", "", $request_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        // Create an array of the request data
        $data = array(
            'budget' => $convert_amount,
            'comment' => $request->comment,
            'status' => $request->status,
        );

        // Perform the API request to update the budget data
        $response = Http::post("https://fms5-iasipgcc.fguardians-fms.com/payment{$id}", $data);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect back to index with success message
            return redirect()->back()->with('success', 'Payment updated successfully.');
        } else {
            // If request fails, redirect back with error message
            return redirect()->back()->with('error', 'Failed to update budget. Please try again.');
        }
    }

    public function expense()
    {
        $API = Http::get('https://fms2-ecabf.fguardians-fms.com/api/expensesApi');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        $data = [
            'budgetData' => $budgetData,
            'statuses' => Status::all(),
        ];

        // Pass the decoded JSON data to the view
        return view('board.new.finance.expense', $data);
    }

    public function expenseUpdate(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'budget' => 'required',
            'comment' => 'required',
            'status' => 'required',
        ]);

        // Convert the amount from the format "₱123,456.78" to "123456.78"
        $request_amount = str_replace("₱", "", $request->budget);
        $convert_amount1 = str_replace(",", "", $request_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        // Create an array of the request data
        $data = array(
            'budget' => $convert_amount,
            'comment' => $request->comment,
            'status' => $request->status,
        );

        // Perform the API request to update the budget data
        $response = Http::post("https://fms2-ecabf.fguardians-fms.com/api/expensesApi{$id}", $data);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect back to index with success message
            return redirect()->back()->with('success', 'Expense updated successfully.');
        } else {
            // If request fails, redirect back with error message
            return redirect()->back()->with('error', 'Failed to update budget. Please try again.');
        }
    }

    public function cost()
    {
        $API = Http::get('https://fms2-ecabf.fguardians-fms.com/api/costApi');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        $data = [
            'budgetData' => $budgetData,
            'statuses' => Status::all(),
        ];

        // Pass the decoded JSON data to the view
        return view('board.new.finance.cost', $data);
    }

    public function costUpdate(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'budget' => 'required',
            'comment' => 'required',
            'status' => 'required',
        ]);

        // Convert the amount from the format "₱123,456.78" to "123456.78"
        $request_amount = str_replace("₱", "", $request->budget);
        $convert_amount1 = str_replace(",", "", $request_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        // Create an array of the request data
        $data = array(
            'budget' => $convert_amount,
            'comment' => $request->comment,
            'status' => $request->status,
        );

        // Perform the API request to update the budget data
        $response = Http::post("https://fms2-ecabf.fguardians-fms.com/api/costApi/{$id}", $data);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect back to index with success message
            return redirect()->back()->with('success', 'Cost updated successfully.');
        } else {
            // If request fails, redirect back with error message
            return redirect()->back()->with('error', 'Failed to update budget. Please try again.');
        }
    }

    public function decryptValue(Request $request)
    {
        $encryptedValue = $request->input('encrypted_value');
        $decryptedValue = Crypt::decryptString($encryptedValue);

        return response()->json(['decrypted_value' => $decryptedValue]);
    }

    public function pullRequests()
    {
        $API = Http::get('https://fms3-swasfcrb.fguardians-fms.com/s-pull-admin-xd-approved');

        // Get the body of the response and decode JSON
        $budgetData = json_decode($API->body(), true);

        $data = [
            'budgetData' => $budgetData,
            'statuses' => Status::all(),
        ];

        // Pass the decoded JSON data to the view
        return view('board.new.finance.pull-requests', $data);
    }



}
