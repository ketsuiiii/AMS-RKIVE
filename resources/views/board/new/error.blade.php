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
    <h3>{{ $role }} Support</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item active">Support</li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Error Occurred</h3>
                    </div>
                    <div class="card-body text-center">
                        <i data-feather="alert-triangle" class="text-danger" style="width: 100px; height: 100px;"></i>
                        <p>We're sorry, but it looks like there is an issue on the connection to the other system has not been established.</p>
                        <p>Please contact the helpdesk for further assistance.</p>
                        <p><strong>Helpdesk Contact:</strong> helpdesk@rkive.com</p>
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
