<?php

namespace App\Http\Controllers\Fragments;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function deptForm()
    {
        $department = Department::orderBy('department_code', 'asc')->get();
        return view('board.department', compact('department'));
    }

    public function deptPost(Request $request)
    {
        $request->validate([
            'department_name' => 'required|unique:g59_departments',

        ]);

        $dept = new Department();
        $dept->department_name = $request->department_name;
        $dept->department_code = Department::max('department_code') + 1;
        $dept->save();

        return redirect()->back()->with('success', 'Department Added Successfully');
    }

}
