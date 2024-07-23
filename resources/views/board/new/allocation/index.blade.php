@php
    $user = auth()->user();
    $name = $user->first_name . ' ' . $user->last_name;
    $role = $user->role->role_name;
    // dd($departments);
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
    <li class="breadcrumb-item">Allocation</li>
    <li class="breadcrumb-item active">Department</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Cost Allocation</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route(strtolower($role) . '.new.allocation.store') }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <x-alert />
                            <div class="row g-3">
                                <div id="inputText" style="display: none">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <x-select label="Department" name="allocation_department" :options="$departments"
                                                valueId="department_code" valueName="department_name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="allocation_type" class="form-label">Select Allocation Type</label>
                                    <select class="form-select" name="allocation_type" id="optional">
                                        <option value="Y">Per Department</option>
                                        <option value="N" selected>All Departments</option>
                                    </select>
                                </div>
                                <div class="col-md-10">
                                    <x-input-peso label="Amount" name="allocation_amount" />
                                </div>
                                <div class="col-md-12">
                                    <x-button type="button" class="w-100 btn-outline-primary"
                                        name="Save" data-bs-toggle="modal"
                                        data-bs-target="#termsModal0" />
                                    <x-checkbox-auth :value="0" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    @foreach ($data as $item)
                        <div class="col-sm-12 col-lg-6">
                            <a href="{{ route(strtolower($role) . '.new.allocation.view', [$item['department_code']]) }}">
                                <div class="card o-hidden welcome-card"
                                    style="background: rgb(2,0,36);
                             background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
                                    <div class="card-body">
                                        <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22"> {{ $item['department_name'] }}</h4>


                                        <h3 class="f-w-400">Remaining Balance: ₱{{ number_format($item['remaining'], 2) }}
                                        </h3>
                                        {{-- <p class="f-w-400">Remaining Budget: ₱{{ number_format($item['remainingBudget'], 2) }} </p> --}}
                                        <h5 class="f-w-400">Total Budget: ₱{{ number_format($item['allocate'], 2) }} </h5>

                                    </div><img class="welcome-img"
                                        src="https://fbs.rkiveadmin.com/rkive-travels/assets/images/dashboard/widget.svg"
                                        alt="search image">
                                </div>
                            </a>
                        </div>
                    @endforeach
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
