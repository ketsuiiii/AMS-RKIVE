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
    <li class="breadcrumb-item">Terms</li>
    <li class="breadcrumb-item active">Punishment</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- Section 1 -->
                <div class="card">
                    <div class="card-header">
                        <h5>Possible Punishments for Violations</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Verbal Warning:</h6>
                                <p> For minor or first-time violations, employees may receive a verbal warning reminding
                                    them of the policy
                                    and the importance of compliance.</p>

                                <h6>Written Warning:</h6>
                                <p> A written warning may be issued for repeated violations or more serious breaches of the
                                    policy. This
                                    warning would be placed in the employee's file.</p>

                                <h6>Suspension:</h6>
                                <p> In cases of serious or intentional violations, employees may be suspended from work for
                                    a specified
                                    period, without pay.</p>

                                <h6>Demotion:</h6>
                                <p> For repeated or severe violations, employees may be demoted to a lower position within
                                    the company, with
                                    corresponding changes in responsibilities and salary.</p>

                                <h6>Termination:</h6>
                                <p> Continued disregard for the policy or serious breaches of confidentiality may result in
                                    termination of
                                    employment.</p>
                            </div>
                        </div>
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
