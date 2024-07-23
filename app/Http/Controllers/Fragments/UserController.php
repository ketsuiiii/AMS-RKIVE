<?php

namespace App\Http\Controllers\Fragments;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Roles;
use App\Models\Department;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userForm()
    {
        $data = [
            'users' => User::all(),
            'departments' => Department::all(),
            'roles' => Roles::all()
        ];
        return view("board.users", $data);
    }

    public function userPost(Request $request)
    {
        $request->validate([
            'profile' => 'required|max:2048|mimes:png,jpg,jpeg',
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'department' => 'required',
            'username' => 'required|unique:g59_users',
            'email' => 'required|email|unique:g59_users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',

        ]);

        if ($request->has('profile')) {

            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();

            $fileName = uniqid() . '.' . $extension;

            $path = 'uploads/category/profile';
            $filePath = $file->move($path, $fileName);
        }

        $user = User::create([
            'profile' => $filePath,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_code' => $request->role,
            'department_code' => $request->department,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userpassword' => $request->password,
        ]);

        return redirect()->back()->with('success', 'User added successfully');

    }

    public function view()
    {
        $id = auth()->user()->id;

        $data = [
            'user' => User::find($id),
            'roles' => Roles::all(),
            'departments' => Department::all()
        ];
        return view("board.accounts", $data);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'department' => 'required',

        ]);

        if ($request->has('profile')) {

            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();

            $fileName = uniqid() . '.' . $extension;

            $path = 'uploads/category/profile';
            $filePath = $file->move($path, $fileName);

            $user->update([
                'profile' => $filePath,
            ]);
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_code' => $request->role,
            'department_code' => $request->department,
        ]);

        return redirect()->back()->with('success', 'User profile updated successfully');
    }

}
