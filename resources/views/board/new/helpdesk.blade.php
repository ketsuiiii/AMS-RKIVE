@php
    $user = auth()->user();
    if ($user == null) {
        $name = 'Guest';
        $role = 'Guest';
    } else {
        $name = $user->first_name . ' ' . $user->last_name;
        $role = $user->role->role_name;
    }
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
    <h3>{{ $role }} Help Desk</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item active">Help Desk</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-left mt-2">
                            <h5>Help Desk</h5>
                        </div>
                        <div class="card-header-right mb-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#account">
                                Info
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <iframe src="https://helpdesk.rkiveadmin.com/integration/login" frameborder="0" width="100%"
                            height="800px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="account" tabindex="-1" aria-labelledby="accountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountLabel">Account Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Incase of any issues, please contact</span><br>
                    <p>Email: <b>daniel@gmail.com</b><br>
                        Password: <b>admin123</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
