@php
    $user = auth()->user();
    $name = $user->first_name . ' ' . $user->last_name;
    $username = $user->username;
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
    <h3>{{ $role }} Budget</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Budget Request</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-left mt-2">
                            <h5>Rkive Request Record</h5>
                        </div>
                        <div class="card-body">
                            <x-alert />
                            <div class="col-sm-12 col-lg-12">
                                <div class="card o-hidden welcome-card"
                                    style="background: rgb(2,0,36);
                            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
                                    <div class="card-body">
                                        <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22"><span> <img
                                                    src="https://fbs.rkiveadmin.com/rkive-travels/assets/images/dashboard/hand.svg"
                                                    alt="hand vector"></span></h4>



                                        <h3 class="f-w-400">Remaining Balance:
                                            ₱{{ number_format($departmentBalance, 2) }} </h3>
                                        <h5 class="f-w-400">Total Budget: ₱ {{ number_format($departmentBudget, 2) }} </h5>

                                    </div><img class="welcome-img"
                                        src="https://fbs.rkiveadmin.com/rkive-travels/assets/images/dashboard/widget.svg"
                                        alt="search image">
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <b>Request Name</b> : {{ $requests->request_name }} <br>
                                        <b>Requestor</b> :
                                        @if ($requests->request_revisedBy != null)
                                            {{ $requests->request_revisedBy }}
                                        @else
                                            {{ $requests->request_createdBy }}
                                        @endif
                                        <br>
                                        @if ($requests->request_email != null)
                                            <b>Requestor Email</b> : {{ $requests->request_email }} <br>
                                        @endif
                                        <b>Department</b> : {{ $requests->department->department_name }} <br>
                                        <b>Category</b> : {{ $requests->category->category_name }} <br>
                                        <b>Amount</b> : &#8369; {{ number_format($requests->request_amount, 2) }} <br>
                                        <b>Period</b> : {{ $requests->periods->period_name }} <br>
                                        <b>Project Details Name</b> : {{ $requests->budget->budget_name ?? 'N/A' }} <br>
                                        <b>Budget Amount</b> : &#8369;
                                        {{ number_format($requests->budget->budget_amount, 2) ?? 'N/A' }} <br>
                                        <b>Actual Spend</b> : &#8369;
                                        {{ number_format($requests->request_actualSpending, 2) }} <br>
                                        <b>Justification</b> : {{ $requests->request_justification }} <br>
                                        <b>Supporting Documents</b> :
                                        {{ $requests->request_supportingDocumentationName }} <a
                                            href="{{ asset($requests->request_supportingDocumentation) }}">View</a><br>
                                        @if ($requests->request_optional === 'Y')
                                            <b>Historical Data</b> :
                                            {{ $requests->request_historicalData ?? 'No' }} <br>
                                            <b>Risk Factors and Contingencies</b> :
                                            {{ $requests->request_riskFactorsAndContingencies ?? 'No' }}
                                            <br>
                                            <b>Impact on Operations</b> :
                                            {{ $requests->request_impactOnOperations ?? 'No' }}
                                            <br>
                                            <b>Alignment with Objectives</b> :
                                            {{ $requests->request_alignmentWithObjectives ?? 'No' }} <br>
                                            <b>Alternatives Considered</b> :
                                            {{ $requests->request_alternativesConsidered ?? 'No' }} <br>
                                            <b>Assumptions and Methodology</b> :
                                            {{ $requests->request_assumptionsAndMethodology ?? 'No' }} <br>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($requests->request_status === 'S2' || $requests->request_status === 'S3')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#user_edit_{{ $requests->id }}">
                                    Revise
                                </button>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#user_delete_{{ $requests->id }}">
                                    Delete
                                </button>
                            @endif

                            <!-- Edit Modal -->
                            <div class="modal fade" id="user_edit_{{ $requests->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Approve Budget</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('employee.new.addbudget.revise', ['id' => $requests->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="card">
                                                    <div class="card-body">
                                                        <b class="text-center mt-2">Request Details</b>
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <x-input-text label="Name" name="request_name"
                                                                    value="{{ $requests->request_name }}" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <x-select-edit label="Category" name="request_category"
                                                                    :options="$categories" valueId="category_code"
                                                                    valueName="category_name"
                                                                    value="{{ $requests->request_category }}" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <x-select-edit label="Period" name="request_period"
                                                                    :options="$periods" valueId="period_code"
                                                                    valueName="period_name"
                                                                    value="{{ $requests->request_period }}" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <x-input-peso label="Amount" name="request_amount"
                                                                    value="{{ $requests->request_amount }}" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <x-date label="Date" name="request_date"
                                                                    id="minMaxExample"
                                                                    value="{{ $requests->request_date }}" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <x-select-edit label="Additional Budget for"
                                                                    name="request_projectDetails" :options="$budgets"
                                                                    valueId="id" valueName="budget_name"
                                                                    value="{{ $requests->request_projectDetails }}" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <x-select-edit label="Relevant Document"
                                                                    name="request_optional" :options="$optionals"
                                                                    valueId="optional_code" valueName="optional_name"
                                                                    id="optional"
                                                                    value="{{ $requests->request_optional }}" />
                                                            </div>
                                                            <div id="inputText" style="display: none">
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Historical Data"
                                                                        name="request_historicalData"
                                                                        value="{{ $requests->request_historicalData }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Risk Factors and Contingencies"
                                                                        name="request_riskFactorsAndContingencies"
                                                                        value="{{ $requests->request_riskFactorsAndContingencies }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Impact on Operations"
                                                                        name="request_impactOnOperations"
                                                                        value="{{ $requests->request_impactOnOperations }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Alignment with Objectives"
                                                                        name="request_alignmentWithObjectives"
                                                                        value="{{ $requests->request_alignmentWithObjectives }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Alternatives Considered"
                                                                        name="request_alternativesConsidered"
                                                                        value="{{ $requests->request_alternativesConsidered }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Assumptions and Methodology"
                                                                        name="request_assumptionsAndMethodology"
                                                                        value="{{ $requests->request_assumptionsAndMethodology }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <x-text-area label="Justification"
                                                                    name="request_justification"
                                                                    value="{{ $requests->request_justification }}" />
                                                            </div>
                                                            <div class="col-md-12">
                                                                <x-input-file label="Supporting Document"
                                                                    name="request_supportingDocumentation"
                                                                    value="{{ $requests->request_supportingDocumentation }}" />
                                                            </div>
                                                            {{-- Revise --}}
                                                            <div class="col-md-12">
                                                                <x-button type="button" class="w-100 btn-outline-primary"
                                                                    name="Save" data-bs-toggle="modal"
                                                                    data-bs-target="#termsModal{{ $request->id }}" />
                                                                <x-checkbox-auth :value="$request->id" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="user_delete_{{ $requests->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Delete Budget</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <b>Request Name</b> : {{ $requests->request_name }} <br>
                                                        <b>Requestor</b> :
                                                        @if ($requests->request_revisedBy != null)
                                                            {{ $requests->request_revisedBy }}
                                                        @else
                                                            {{ $requests->request_createdBy }}
                                                        @endif
                                                        <br>
                                                        @if ($requests->request_email != null)
                                                            <b>Requestor Email</b> : {{ $requests->request_email }} <br>
                                                        @endif
                                                        <b>Department</b> : {{ $requests->department->department_name }}
                                                        <br>
                                                        <b>Category</b> : {{ $requests->category->category_name }} <br>
                                                        <b>Amount</b> : &#8369;
                                                        {{ number_format($requests->request_amount, 2) }} <br>
                                                        <b>Period</b> : {{ $requests->periods->period_name }} <br>
                                                        <b>Project Details Name</b> :
                                                        {{ $requests->budget->budget_name ?? 'N/A' }} <br>
                                                        <b>Budget Amount</b> : &#8369;
                                                        {{ number_format($requests->budget->budget_amount, 2) ?? 'N/A' }}
                                                        <br>
                                                        <b>Actual Spend</b> : &#8369;
                                                        {{ number_format($requests->request_actualSpending, 2) }} <br>
                                                        <b>Justification</b> : {{ $requests->request_justification }} <br>
                                                        <b>Supporting Documents</b> :
                                                        {{ $requests->request_supportingDocumentationName }} <a
                                                            href="{{ asset($requests->request_supportingDocumentation) }}">View</a><br>
                                                        @if ($requests->request_optional === 'Y')
                                                            <b>Historical Data</b> :
                                                            {{ $requests->request_historicalData ?? 'No' }} <br>
                                                            <b>Risk Factors and Contingencies</b> :
                                                            {{ $requests->request_riskFactorsAndContingencies ?? 'No' }}
                                                            <br>
                                                            <b>Impact on Operations</b> :
                                                            {{ $requests->request_impactOnOperations ?? 'No' }}
                                                            <br>
                                                            <b>Alignment with Objectives</b> :
                                                            {{ $requests->request_alignmentWithObjectives ?? 'No' }} <br>
                                                            <b>Alternatives Considered</b> :
                                                            {{ $requests->request_alternativesConsidered ?? 'No' }} <br>
                                                            <b>Assumptions and Methodology</b> :
                                                            {{ $requests->request_assumptionsAndMethodology ?? 'No' }}
                                                            <br>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <form
                                                action="{{ route('employee.new.addbudget.delete', ['id' => $requests->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="card">
                                                    <div class="card-body">
                                                        {{-- Delete --}}
                                                        <div class="col-md-12">
                                                            <x-button type="button" class="w-100 btn-outline-primary"
                                                                name="Reject" data-bs-toggle="modal"
                                                                data-bs-target="#termsModal{{ $request->id }}1" />
                                                            <x-checkbox-auth :value="$request->id . '1'" />
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
