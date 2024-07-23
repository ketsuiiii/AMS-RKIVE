@extends('layouts.custom.auth')

@section('title', 'Default')

@section('style')
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card centered-div">
                    <div class="card-body">
                        <h3>Use this code to Add a user for this system</h3><br>
                        <p class="text-info"> Copy and paste this in controller.</p>
        <pre class="bg-dark" style="color: white">
        DB::table('g59_users')->insert([
            'profile' => 'uploads/category/profile\65fc2dd52f3e9.png',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_code' => $request->role, // 102 = Admin, 103 = Employee
            'department_code' => $request->department,// 1001 = Admin, 1002 = HR, 1003 = Logistic &nbsp;&nbsp;
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userpassword' => $request->password, // same as password
            ]);
        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
@endsection
