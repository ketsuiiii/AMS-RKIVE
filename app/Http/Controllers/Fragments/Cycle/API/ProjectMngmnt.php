<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use App\Models\ProjectManagement;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class ProjectMngmnt extends Controller
{
    public function index()
    {
        try {
            $data = [
                'management' => ProjectManagement::all(),
            ];
        } catch (QueryException $e) {
            // Check if the exception is because of a missing table
            if ($e->getCode() == '42S02') {
                // '42S02' is the SQL state code for "base table or view not found"
                return view('board.new.not_found');
            }
            // If it's a different exception, rethrow it or handle it accordingly
            throw $e;
        }

        return view('board.new.projectmanagement.index', $data);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            // 'terms' => 'required',
            'budget' => 'required',
            // 'is_confirm' => 'required',
        ]);


        // dd($request->budget);
        $project_amount = str_replace("₱", "", $request->budget);
        $convert_amount1 = str_replace(",", "", $project_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        $management = ProjectManagement::find($id);

        //   dd($request->is_confirm, $request->budget, $management);
        $management->update([
            'budgeting_financial' => $convert_amount,
            // 'is_confirm' => $request->is_confirm,
        ]);

        return back()->with('success', 'Project Management Approved successfully');
    }

    public function search(Request $request)
    {
        $search = $request->search;


        if (empty($search)) {
            $requests = ProjectManagement::all();
        } else {
            $requests = ProjectManagement::where('projectTitle', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->orWhere('budget', 'like', '%' . $search . '%')
                ->orWhere('contactNumber', 'like', '%' . $search . '%')
                ->orWhere('is_confirm', 'like', '%' . $search . '%')
                ->orWhere('is_active', 'like', '%' . $search . '%')->get();
        }

        $data = [
            'management' => $requests,
        ];

        return view('board.new.projectmanagement.index', $data);
    }
}
