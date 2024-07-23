<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;


class IncidentReport extends Controller
{
    public function index()
    {
        try {
            $API = Http::get('https://emergency.rkiveadmin.com/public/api/incidentsresponse');
        } catch (QueryException $e) {
            // Check if the exception is because of a missing table
            if ($e->getCode() == '42S02') {
                // '42S02' is the SQL state code for "base table or view not found"
                return view('board.new.not_found');
            }
            // If it's a different exception, rethrow it or handle it accordingly
            throw $e;
        }

        // Get the body of the response and decode JSON
        $incident = $API->json();

        $data = [
            'incident' => $incident['incidentresponses'],
            'personnels' => $incident['team_personnels'],
        ];

        // dd($data);

        return view('board.new.incident_report', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner' => 'required',
            'title' => 'required',
            'description' => 'required',
            'importance' => 'required',
        ]);

        $data = array(
            'owner' => $request->owner,
            'title' => $request->title,
            'description' => $request->description,
            'importance' => $request->importance,
        );

        // Perform the API request to update the budget data
        $response = Http::post("https://emergency.rkiveadmin.com/public/api/incidentsresponse", $data);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect back to index with success message
            return redirect()->back()->with('success', 'Incident report created successfully.');
        } else {
            // If request fails, redirect back with error message
            return redirect()->back()->with('error', 'Failed to create incident report. Please try again.');
        }
    }
}
