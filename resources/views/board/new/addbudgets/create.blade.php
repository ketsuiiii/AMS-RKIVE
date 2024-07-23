@php
    $user = auth()->user();
    $name = $user->first_name . ' ' . $user->last_name;
    $role = $user->role->role_name;

    // dd($data);

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
    <h3>{{ $role }} Budget</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Budget</li>
    <li class="breadcrumb-item active">Request</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    @if ($role == 'Admin')
                        @foreach ($data as $item)
                            <div class="col-sm-12 col-lg-6">
                                <a
                                    href="{{ route('' . strtolower($role) . '.new.allocation.view', [$item['department_code']]) }}">
                                    <div class="card o-hidden welcome-card"
                                        style="background: rgb(2,0,36);
                     background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
                                        <div class="card-body">
                                            <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22"><span> <img
                                                        src="https://fbs.rkiveadmin.com/rkive-travels/assets/images/dashboard/hand.svg"
                                                        alt="hand vector"></span> {{ $item['department_name'] }}</h4>


                                            <h3 class="f-w-400">Remaining Balance:
                                                ₱{{ number_format($item['remaining'], 2) }}
                                            </h3>
                                            <h5 class="f-w-400">Total Budget: ₱{{ number_format($item['allocate'], 2) }}
                                            </h5>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        {{-- @dd($data); --}}
                        <div class="col-sm-12 col-lg-12">
                            <a
                                href="{{ route('' . strtolower($role) . '.new.allocation.view', $data['department_code']) }}">
                                <div class="card o-hidden welcome-card"
                                    style="background: rgb(2,0,36);
                     background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
                                    <div class="card-body">
                                        <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22"><span> <img
                                                    src="https://fbs.rkiveadmin.com/rkive-travels/assets/images/dashboard/hand.svg"
                                                    alt="hand vector"></span> {{ $data['department_name'] }}</h4>


                                        <h3 class="f-w-400">Remaining Balance: ₱{{ number_format($data['remaining'], 2) }}
                                        </h3>
                                        <h5 class="f-w-400">Total Budget: ₱{{ number_format($data['allocate'], 2) }} </h5>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="default-according mb-3" id="accordion">
                    <div class="card">
                        <div class="card-header ">
                            <x-button type="button" name="Create an Request" class="w-100 btn-outline-secondary"
                                data-bs-toggle="collapse" data-bs-target="#create" aria-expanded="true"
                                aria-controls="collapseOne" />
                        </div>
                        <div class="collapse show" id="create" aria-labelledby="headingOne" data-bs-parent="#accordion">
                            <div class="card">
                                <div class="card-body">
                                    <x-alert />
                                    <form action="{{ route('' . strtolower($role) . '.new.addbudget.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <b class="text-center mt-2">Request Details</b>
                                                <div class="row g-3">
                                                    <div class="col-md-4">
                                                        <x-input-text label="Name" name="request_name" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <x-select label="Category" name="request_category" :options="$categories"
                                                            valueId="category_code" valueName="category_name" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <x-select label="Period" name="request_period" :options="$periods"
                                                            valueId="period_code" valueName="period_name" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-input-peso label="Amount" name="request_amount" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-date label="Date" name="request_date" id="minMaxExample" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <x-select label="Additional Budget for"
                                                            name="request_projectDetails" :options="$budgets" valueId="id"
                                                            valueName="budget_name" />
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="budget_optional" class="form-label">Relevant
                                                            Document</label>
                                                        <select class="form-select" name="request_optional" id="optional">
                                                            <option value="Y">Yes</option>
                                                            <option value="N" selected>No</option>
                                                        </select>
                                                    </div>
                                                    <div id="inputText" style="display: none">
                                                        <div class="col-md-12">
                                                            <x-text-area label="Historical Data"
                                                                name="request_historicalData" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-text-area label="Risk Factors and Contingencies"
                                                                name="request_riskFactorsAndContingencies" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-text-area label="Impact on Operations"
                                                                name="request_impactOnOperations" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-text-area label="Alignment with Objectives"
                                                                name="request_alignmentWithObjectives" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-text-area label="Alternatives Considered"
                                                                name="request_alternativesConsidered" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <x-text-area label="Assumptions and Methodology"
                                                                name="request_assumptionsAndMethodology" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <x-text-area label="Justification" name="request_justification" />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <x-input-file label="Supporting Document"
                                                            name="request_supportingDocumentation" />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <x-button type="button" class="w-100 btn-outline-primary"
                                                            name="Save" data-bs-toggle="modal"
                                                            data-bs-target="#termsModal0" />
                                                        <x-checkbox-auth :value="0" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
