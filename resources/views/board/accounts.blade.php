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
    <!-- Datepicker CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
    <h3>{{ $role }} Account</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Account</li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-left mt-2">
                            <h5>{{ $name }}'s Account</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="card col-md-4"
                                style="background: linear-gradient(75deg, #6f00b0, #c93d3d); color: white">
                                <div class="card-body">
                                    <div class="col-md-12 text-center">
                                        <img src="{{ asset($user->profile) }}" alt="Profile"
                                            style="width: 100px; height: 100px" class="rounded-circle">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="box mt-3 text-center">
                                            <h2>{{ $name }}</h2>
                                        </div>
                                        <br>
                                        <br>
                                        <h6 class="">Email: {{ $user->email }}</h6>
                                        <h6 class="">Employee ID: {{ $user->id }}</h6>
                                        <h6 class="">Username: {{ $user->username }}</h6>
                                        <h6 class="">Department: {{ $user->department->department_name }}</h6>
                                        <h6 class="">Position: {{ $user->role->role_name }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-7" style="margin-left: 10px">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <x-input-text label="First Name" name="first_name"
                                                value="{{ $user->first_name }}" disabled />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-text label="Last Name" name="last_name" value="{{ $user->last_name }}"
                                                disabled />
                                        </div>
                                        <div class="col-md-6">
                                            <x-select-edit label="Department" name="department" :options="$departments"
                                                valueId="department_code" valueName="department_name"
                                                value="{{ $user->department_code }}" disabled />
                                        </div>
                                        <div class="col-md-6">
                                            <x-select-edit label="Role" name="role" :options="$roles"
                                                valueId="role_code" valueName="role_name" value="{{ $user->role_code }}"
                                                disabled />
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-email label="Email" name="email" value="{{ $user->email }}"
                                                disabled />
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-text label="Username" name="username" value="{{ $user->username }}"
                                                disabled />
                                        </div>
                                        <div class="col-md-12">
                                            <x-input-text label="Password" name="password"
                                                value="{{ $user->userpassword }}" disabled />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-outline-primary w-100"
                                                data-bs-toggle="modal" data-bs-target="#updateProfile">
                                                Update Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <x-alert />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="updateProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-2"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateProfile', ['id' => $user->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <x-input-file label="Profile" name="profile" value="{{ $user->profile }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-text label="First Name" name="first_name"
                                        value="{{ $user->first_name }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-text label="Last Name" name="last_name" value="{{ $user->last_name }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-select-edit label="Department" name="department" :options="$departments"
                                        valueId="department_code" valueName="department_name"
                                        value="{{ $user->department_code }}" />
                                </div>
                                <div class="col-md-6">
                                    <x-select-edit label="Role" name="role" :options="$roles" valueId="role_code"
                                        valueName="role_name" value="{{ $user->role_code }}" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-password label="Password" name="password"
                                        value="{{ $user->userpassword }}" />
                                </div>
                                <div class="col-md-12">
                                    <x-input-password label="Confirm Password" name="password_confirmation"
                                        value="{{ $user->userpassword }}" />
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
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
