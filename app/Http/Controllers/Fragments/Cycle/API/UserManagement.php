<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Roles;

class UserManagement extends Controller
{
    public function userForm()
    {
        $data = [
            'users' => User::all(),
            'departments' => Department::all(),
            'roles' => Roles::all()
        ];
        return view("auth.g53.register", $data);
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'department' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',

        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_code' => $request->role,
            'department' => $request->department,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        auth()->login($user);

        return redirect()->back()->with('success', 'User Added Successfully');
    }
}
