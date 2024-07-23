<?php

namespace App\Http\Controllers\Fragments\Cycle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

use App\Models\Travels;
use App\Models\Department;
use App\Models\Categories;
use App\Models\Optional;
use App\Models\Period;
use App\Models\Allocation;
use App\Models\BudgetRequest;
use App\Models\AddBudgetRequest;

class TravelRqst extends Controller
{
    public function index()
    {
        try {
            // $users = User::all();
            // $travels = Travels::all();
            $travels = Travels::with('user')
                // ->where('status', 'Pending')
                ->get();
        } catch (QueryException $e) {
            // Check if the exception is because of a missing table
            if ($e->getCode() == '42S02') {
                if (auth()->user()->role_code === '103') {
                    return view('board.new.error');
                } else {
                    // '42S02' is the SQL state code for "base table or view not found"
                    return view('board.new.not_found');
                }
            }
            // If it's a different exception, rethrow it or handle it accordingly
            throw $e;
        }



        return view('board.new.travel.index', compact('travels'));
    }

    public function viewTravel($RequestID)
    {
        // $travels = Travels::where('RequestID', $RequestID)->get();
        $view = Travels::with('user')->where('RequestID', $RequestID)->first();

        // Check if the request was found
        if (!$view) {
            return abort(404); // Handle the case where the request doesn't exist
        }

        // The user data is already loaded through eager loading
        $user = $view->user;
        return view('board.new.travel.view', compact('view'));
    }

    public function update(Request $request, $RequestID)
    {
        $validatedData = $request->validate([
            'Status' => 'required',
            'ApprovedBy' => 'required',
            'DateApproved' => 'required',
            'Notes' => 'required',
        ]);

        // Retrieve the travel record by RequestID
        $travel = Travels::where('RequestID', $RequestID);

        if ($request->Status == "Approved") {
            // Update the travel record with the validated data
            $travel->update($validatedData);

            // Optionally, you can redirect the user to a specific route
            return back()->with('success', 'Travel Request Approved successfully.');
        } else {
            // Update the travel record with the validated data
            $travel->update($validatedData);

            // Optionally, you can redirect the user to a specific route
            return back()->with('success', 'Travel Request Rejected successfully.');
        }

    }

    public function revise(Request $request, $RequestID)
    {
        $validatedData = $request->validate([
            'TotalEstimatedBudget' => 'required',
            'Status' => 'required',
            'ApprovedBy' => 'required',
            'DateApproved' => 'required',
            'Notes' => 'required',

        ]);

        $track_amount = str_replace("₱", "", $request->TotalEstimatedBudget);
        $convert_amount1 = str_replace(",", "", $track_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'


        $travel = Travels::where('RequestID', $RequestID);

        // Update the travel record with the validated data
        $travel->update([
            'TotalEstimatedBudget' => $convert_amount,
            'Status' => $request->Status,
            'ApprovedBy' => $request->ApprovedBy,
            'DateApproved' => $request->DateApproved,
            'Notes' => $request->Notes
        ]);

        // Optionally, you can redirect the user to a specific route
        return back()->with('success', 'Travel Request Revised successfully.');
    }



    public function search(Request $request)
    {
        $search = $request->search;

        // If the search string is null or blank, display all travel records
        // Otherwise, filter travel records by the search string
        if (empty($search)) {
            $requests = Travels::where('status', 'Pending')->get();
        } else {
            $requests = Travels::where('status', 'Pending')
                ->where(function ($query) use ($search) {
                    $query->where('Title', 'like', '%' . $search . '%')
                        ->orWhere('ExpectedOutcomes', 'like', '%' . $search . '%')
                        ->orWhere('TotalEstimatedBudget', 'like', '%' . $search . '%')
                        ->orWhere('RequestID', 'like', '%' . $search . '%')
                        ->orWhere('UserID', 'like', '%' . $search . '%');
                })->get();
        }

        $data = [
            'travels' => $requests,
            'users' => User::all(),
        ];

        return view('board.new.travel.index', $data);
    }

}
