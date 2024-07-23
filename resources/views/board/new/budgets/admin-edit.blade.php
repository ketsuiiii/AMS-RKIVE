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
                                    data-bs-target="#admin_approve_{{ $request->id }}">
                                    Approve
                                </button>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#admin_reject_{{ $request->id }}">
                                    Reject
                                </button>
                            @endif


                            <!-- Approve Modal -->
                            <div class="modal fade" id="admin_approve_{{ $request->id }}" data-bs-backdrop="static"
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
                                            <div class="card">
                                                <div class="card-body">
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
                                                                <h5 class="f-w-400">Total Budget: ₱
                                                                    {{ number_format($departmentBudget, 2) }} </h5>

                                                            </div><img class="welcome-img"
                                                                src="https://fbs.rkiveadmin.com/rkive-travels/assets/images/dashboard/widget.svg"
                                                                alt="search image">
                                                        </div>
                                                    </div>
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
                                                            {{ $request->budget_riskFactorsAndContingencies ?? 'No' }} <br>
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
                                            <form action="{{ route('admin.new.budget.update', ['id' => $request->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row g-3">
                                                            <div style="display: none">
                                                                <div class="col-md-4">
                                                                    <x-input-text label="Status" name="budget_status"
                                                                        value="S1" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <x-input-text label="Approver" name="budget_approvedBy"
                                                                        value="{{ $username }}" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <x-date label="Approved Date" name="budget_approvedDate"
                                                                        value="{{ date('Y-m-d') }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <x-input-peso label="Approved Amount"
                                                                    name="budget_approvedAmount"
                                                                    value="{{ number_format($request->budget_amount, 2) }}" />
                                                            </div>
                                                            <div class="col-md-12">
                                                                <x-text-area label="Notes" name="budget_notes"
                                                                    value="{{ $request->budget_notes }}" />
                                                            </div>
                                                            {{-- Approved --}}
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

                            <!-- Reject Modal -->
                            <div class="modal fade" id="admin_reject_{{ $request->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Reject Budget</h5>
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
                                                            {{ $request->budget_riskFactorsAndContingencies ?? 'No' }} <br>
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
                                            <form action="{{ route('admin.new.budget.update', ['id' => $request->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row g-3">
                                                            <div style="display: none">
                                                                <div class="col-md-4">
                                                                    <x-input-text label="Status" name="budget_status"
                                                                        value="S3" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <x-input-text label="Approver"
                                                                        name="budget_approvedBy"
                                                                        value="{{ $username }}" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <x-date label="Approved Date"
                                                                        name="budget_approvedDate"
                                                                        value="{{ date('Y-m-d') }}" />
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <x-date label="Approved Amount"
                                                                        name="budget_approvedAmount" value="0.00" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <x-text-area label="Notes" name="budget_notes"
                                                                    value="{{ $request->budget_notes }}" />
                                                            </div>
                                                            {{-- Reject --}}
                                                            <div class="col-md-12">
                                                                <x-button type="button" class="w-100 btn-outline-primary"
                                                                    name="Reject" data-bs-toggle="modal"
                                                                    data-bs-target="#termsModal{{ $request->id }}1" />
                                                                <x-checkbox-auth :value="$request->id . '1'" />
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
