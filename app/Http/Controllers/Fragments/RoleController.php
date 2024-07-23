<?php

namespace App\Http\Controllers\Fragments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;

class RoleController extends Controller
{
    public function roleForm()
    {
        $roles = Roles::orderBy('role_code', 'asc')->get();
        return view('board.role', compact('roles'));
    }

    public function rolePost(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:g59_roles',

        ]);

        $role = new Roles();
        $role->role_name = $request->role_name;
        $role->role_code = Roles::max('role_code') + 1;
        $role->save();

        return redirect()->back()->with('success', 'Role Added Successfully');
    }

}
