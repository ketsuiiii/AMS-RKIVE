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
    <li class="breadcrumb-item">Budget</li>
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
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-6">
                                        <b>Budget Name</b> : {{ $request->budget_name }} <br>
                                        <b>Requestor</b> :
                                        @if ($request->budget_revisedBy != null)
                                            {{ $request->budget_revisedBy }}
                                        @else
                                            {{ $request->budget_createdBy }}
                                        @endif
                                        <br>
                                        @if ($request->budget_email != null)
                                            <b>Requestor Email</b> : {{ $request->budget_email }} <br>
                                        @endif
                                        <b>Department</b> : {{ $request->department->department_name }} <br>
                                        <b>Category</b> : {{ $request->category->category_name }} <br>
                                        <b>Amount</b> : &#8369; {{ number_format($request->budget_amount, 2) }} <br>
                                        <b>Period</b> : {{ $request->periods->period_name }} <br>
                                        <b>Date</b> : {{ $request->budget_date }} <br>
                                        <b>Justification</b> : {{ $request->budget_justification }} <br>
                                        <b>Supporting Documents</b> : {{ $request->budget_supportingDocumentationName }} <a
                                            href="{{ asset($request->budget_supportingDocumentation) }}">View</a><br>
                                        @if ($request->budget_optional === 'Y')
                                            <b>Historical Data</b> : {{ $request->budget_historicalData ?? 'No' }} <br>
                                            <b>Risk Factors and Contingencies</b> :
                                            {{ $request->budget_riskFactorsAndContingencies ?? 'No' }} <br>
                                            <b>Impact on Operations</b> : {{ $request->budget_impactOnOperations ?? 'No' }}
                                            <br>
                                            <b>Alignment with Objectives</b> :
                                            {{ $request->budget_alignmentWithObjectives ?? 'No' }} <br>
                                            <b>Alternatives Considered</b> :
                                            {{ $request->budget_alternativesConsidered ?? 'No' }} <br>
                                            <b>Assumptions and Methodology</b> :
                                            {{ $request->budget_assumptionsAndMethodology ?? 'No' }} <br>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($request->budget_status === 'S2' || $request->budget_status === 'S3')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#user_edit_{{ $request->id }}">
                                    Revise
                                </button>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#user_delete_{{ $request->id }}">
                                    Delete
                                </button>
                            @endif

                            <!-- Edit Modal -->
                            <div class="modal fade" id="user_edit_{{ $request->id }}" data-bs-backdrop="static"
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
                                                action="{{ route('employee.new.budget.revise', ['id' => $request->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <b class="text-center mt-2">Request Details</b>
                                                        <div class="row mb-2 g-3">
                                                            <div class="col-md-4">
                                                                <x-input-text label="Name" name="budget_name"
                                                                    value="{{ $request->budget_name }}" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <x-select-edit label="Department" name="budget_department"
                                                                    :options="$departments" valueId="department_code"
                                                                    valueName="department_name"
                                                                    value="{{ $request->budget_department }}" />
                                                            </div>
                                                            <div class="col-md-4">
                                                                <x-select-edit label="Category" name="budget_category"
                                                                    :options="$categories" valueId="category_code"
                                                                    valueName="category_name"
                                                                    value="{{ $request->budget_category }}" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <x-input-peso label="Amount" name="budget_amount"
                                                                    value="{{ number_format($request->budget_amount, 2) }}" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <x-select-edit label="Period" name="budget_period"
                                                                    :options="$periods" valueId="period_code"
                                                                    valueName="period_name"
                                                                    value="{{ $request->budget_period }}" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <x-date label="Date" name="budget_date"
                                                                    id="minMaxExample2"
                                                                    value="{{ $request->budget_date }}" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <x-select-edit label="Relevant Document"
                                                                    name="budget_optional" :options="$optionals"
                                                                    valueId="optional_code" valueName="optional_name"
                                                                    id="optional"
                                                                    value="{{ $request->budget_optional }}" />
                                                            </div>
                                                            <div id="inputText" style="display: none">
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Historical Data"
                                                                        name="budget_historicalData"
                                                                        value="{{ $request->budget_historicalData }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Risk Factors and Contingencies"
                                                                        name="budget_riskFactorsAndContingencies"
                                                                        value="{{ $request->budget_riskFactorsAndContingencies }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Impact on Operations"
                                                                        name="budget_impactOnOperations"
                                                                        value="{{ $request->budget_impactOnOperations }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Alignment with Objectives"
                                                                        name="budget_alignmentWithObjectives"
                                                                        value="{{ $request->budget_alignmentWithObjectives }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Alternatives Considered"
                                                                        name="budget_alternativesConsidered"
                                                                        value="{{ $request->budget_alternativesConsidered }}" />
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <x-text-area label="Assumptions and Methodology"
                                                                        name="budget_assumptionsAndMethodology"
                                                                        value="{{ $request->budget_assumptionsAndMethodology }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <x-text-area label="Justification"
                                                                    name="budget_justification"
                                                                    value="{{ $request->budget_justification }}" />
                                                            </div>
                                                            <div class="col-md-12">
                                                                <x-input-file label="Supporting Document"
                                                                    name="budget_supportingDocumentation"
                                                                    value="{{ $request->budget_supportingDocumentation }}" />
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
                            <div class="modal fade" id="user_delete_{{ $request->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="1" aria-labelledby="staticBackdropLabel1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel1">Delete Budget</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <b>Budget Name</b> : {{ $request->budget_name }} <br>
                                                        <b>Requestor</b> :
                                                        @if ($request->budget_revisedBy != null)
                                                            {{ $request->budget_revisedBy }}
                                                        @else
                                                            {{ $request->budget_createdBy }}
                                                        @endif
                                                        <br>
                                                        @if ($request->budget_email != null)
                                                            <b>Requestor Email</b> : {{ $request->budget_email }} <br>
                                                        @endif
                                                        <b>Department</b> : {{ $request->department->department_name }}
                                                        <br>
                                                        <b>Category</b> : {{ $request->category->category_name }} <br>
                                                        <b>Amount</b> : &#8369;
                                                        {{ number_format($request->budget_amount, 2) }} <br>
                                                        <b>Period</b> : {{ $request->periods->period_name }} <br>
                                                        <b>Date</b> : {{ $request->budget_date }} <br>
                                                        <b>Justification</b> : {{ $request->budget_justification }} <br>
                                                        <b>Supporting Documents</b> :
                                                        {{ $request->budget_supportingDocumentationName }} <a
                                                            href="{{ asset($request->budget_supportingDocumentation) }}">View</a><br>
                                                        @if ($request->budget_optional === 'Y')
                                                            <b>Historical Data</b> :
                                                            {{ $request->budget_historicalData ?? 'No' }} <br>
                                                            <b>Risk Factors and Contingencies</b> :
                                                            {{ $request->budget_riskFactorsAndContingencies ?? 'No' }}
                                                            <br>
                                                            <b>Impact on Operations</b> :
                                                            {{ $request->budget_impactOnOperations ?? 'No' }}
                                                            <br>
                                                            <b>Alignment with Objectives</b> :
                                                            {{ $request->budget_alignmentWithObjectives ?? 'No' }} <br>
                                                            <b>Alternatives Considered</b> :
                                                            {{ $request->budget_alternativesConsidered ?? 'No' }} <br>
                                                            <b>Assumptions and Methodology</b> :
                                                            {{ $request->budget_assumptionsAndMethodology ?? 'No' }} <br>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <form
                                                action="{{ route('employee.new.budget.delete', ['id' => $request->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card">
                                                    {{-- Delete --}}
                                                    <div class="col-md-12">
                                                        <x-button type="button" class="w-100 btn-outline-primary"
                                                            name="Reject" data-bs-toggle="modal"
                                                            data-bs-target="#termsModal{{ $request->id }}1" />
                                                        <x-checkbox-auth :value="$request->id . '1'" />
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
