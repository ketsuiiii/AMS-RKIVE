@php
    $user = auth()->user();
    $name = $user->first_name . ' ' . $user->last_name;
    $role = $user->role->role_name;
@endphp

@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ $role }} Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Employee List</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create New Employee Accounts</h5>
                    </div>
                    <div class="card-body">
                        <x-alert />
                        <form action="{{ route('userPost') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <x-input-file label="Profile" name="profile" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-text label="First Name" name="first_name" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-text label="Last Name" name="last_name" />
                                </div>
                                <div class="col-md-6">
                                    <x-select label="Department" name="department" :options="$departments"
                                        valueId="department_code" valueName="department_name" />
                                </div>
                                <div class="col-md-6">
                                    <x-select label="Role" name="role" :options="$roles" valueId="role_code"
                                        valueName="role_name" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-email label="Email" name="email" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-text label="Username" name="username" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-password label="Password" name="password" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-password label="Confirm Password" name="password_confirmation" />
                                </div>
                                {{-- Approved --}}
                                <div class="col-md-12">
                                    <x-button type="button" class="w-100 btn-outline-primary" name="Save"
                                        data-bs-toggle="modal" data-bs-target="#termsModal0" />
                                    <x-checkbox-auth :value="0" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Employee Accounts</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Userpassword</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td><img src="{{ asset($user->profile) }}" style="width: 30px; height:30px;"
                                                class="rounded-circle" alt="profile" /></td>
                                        <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                        <td>{{ $user->department->department_name }}</td>
                                        <td>{{ $user->role->role_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->userpassword }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
