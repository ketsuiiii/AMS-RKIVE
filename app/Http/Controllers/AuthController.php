<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Department;
use App\Models\G53Users;

class AuthController extends Controller
{
    public function superAdmin()
    {
        $credentials = [
            'email' => 'auth@rkive.com',
            'password' => 'auth',
        ];

        if (auth()->attempt($credentials)) {
            return $this->redirectToDashboard(auth()->user()->role_code);
        }
    }

    public function login()
    {

        if (auth()->check()) {
            return $this->redirectToDashboard(auth()->user()->role_code);
        }

        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required',
            'password' => 'required',
        ]);

        $users['password'] = $request->password;

        if (filter_var($request->username_or_email, FILTER_VALIDATE_EMAIL)) {
            $users['email'] = $request->username_or_email;
        } else {
            $users['username'] = $request->username_or_email;
        }

        if (auth()->attempt($users)) {
            return $this->redirectToDashboard(auth()->user()->role_code);
        }

        return redirect()->route('login')->with('error_message', 'User not found in database.')->withInput();
    }

    public function redirectToDashboard($roleCode)
    {
        if ($roleCode === '101') {
            $dashboardLink = route('developer');
        } elseif ($roleCode === '102') {
            $dashboardLink = route('admin');
        } elseif ($roleCode === '103') {
            $dashboardLink = route('employee');
        } else {
            $dashboardLink = route('index');
        }

        return redirect()->to($dashboardLink)->with('success', 'You have been successfully logged in.');
    }

    public function block()
    {
        return view('auth.block');
    }

    public function blockPost()
    {
        $roleCode = auth()->user()->role_code;

        if ($roleCode === '101') {
            $dashboardLink = route('developer');
        } elseif ($roleCode === '102') {
            $dashboardLink = route('admin');
        } elseif ($roleCode === '103') {
            $dashboardLink = route('employee');
        } else {
            $dashboardLink = route('index');
        }

        return redirect()->to($dashboardLink);

    }

    public function logout()
    {
        $user = auth()->user();
        $data = [
            'username_or_email' => $user['email'],
            'password' => $user['userpassword'],
        ];
        auth()->logout();
        return redirect()->route('login')->with('success', 'You have been successfully logged out.')->withInput($data);
    }

    public function register()
    {
        if (auth()->check()) {
            return $this->redirectToDashboard(auth()->user()->role_code);
        }

        $data = [
            'departments' => Department::all(),
            'roles' => Roles::all(),
            'users' => User::all(),
        ];

        return view('auth.register', $data);
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

            $path = 'uploads/category/';
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

        auth()->login($user);

        return $this->redirectToDashboard(auth()->user()->role_code);

    }

    public function resetForm()
    {
        return view('auth.reset');
    }

    public function resetPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('username', $request->username)
            ->where('email', $request->email)
            ->first();

        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $user->password = bcrypt($request->password);
                $user->userpassword = $request->password;
                $user->save();
                return redirect()->route('login')->with('success', 'Password reset successfully.');
            } else {
                return redirect()->route('login')->with('error_message', 'Invalid password confirmation.');
            }
        } else {
            return redirect()->route('login')->with('error_message', 'Username or email not found.');
        }
    }


    public function extendSession()
    {
        $user = auth()->user();
        $data = [
            'username_or_email' => $user['email'],
            'password' => $user['userpassword'],
        ];
        return view('auth.extend', $data);
    }

}
