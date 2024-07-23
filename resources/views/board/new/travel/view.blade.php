@php
    $user = auth()->user();
    $name = $user->first_name . ' ' . $user->last_name;
    $role = $user->role->role_name;
@endphp

@extends('layouts.master')

@section('title', 'Admin Budget')


@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Travel Request</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item">Travel</li>
    <li class="breadcrumb-item active">Requests</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 border border-primary card">
                <div class="card-header row">
                    <div class="col-6">
                        <h3>Request Summary</h3>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-outline-primary m-1" type="button" data-bs-toggle="modal"
                            data-bs-target="#approve">Approve</button>
                        <button class="btn btn-outline-warning m-1" type="button" data-bs-toggle="modal"
                            data-bs-target="#revise">Revise</button>
                        <button class="btn btn-outline-danger m-1" type="button" data-bs-toggle="modal"
                            data-bs-target="#reject">Reject</button>
                    </div>
                </div>
                <div class="card-body row">
                    <x-alert />
                    <p class="btn btn-outline-success btn-sm">Status: {{ $view->Status }}</p>
                    <div class="col-6">
                        <p>Title: {{ $view->Title }}</p>
                        <p>Requestor: {{ $view->first_name }} {{ $view->last_name }}</p>
                        <p>Department: {{ $view->Department }}</p>
                        <p>Destination: {{ $view->Destinations }}</p>
                        <p>Request ID: {{ $view->RequestID }}</p>
                        <p>Start Date: {{ $view->StartDate }}</p>
                        <p>End Date: {{ $view->EndDate }}</p>
                        <p>Purpose: {{ $view->PurposeOfTravel }}</p>
                        <p>Number of travelers: {{ $view->NumberOfTravelers }}</p>
                        <p>Type of accommodation: {{ $view->TypeOfAccomodation }}</p>
                        <hr>
                        <p>Justification: {{ $view->Justification }}</p>
                        <p>Expected outcomes: {{ $view->ExpectedOutcomes }}</p>
                        <p>Attachments: {{ $view->Attachments }} <a href="http://fbs.rkiveadmin.com/rkive-travels/uploads/category/budgets/travels/{{ $view->Attachments }}" target="_blank"> View</a></p>
                    </div>
                    <div class="col-6">
                        <h4>Cost Estimates</h4>
                        <p>Transportation: ₱
                            {{ $view->TransportationCost ? number_format($view->TransportationCost, 2) : 'Not Specified' }}
                        </p>
                        <p>Accomodation:
                            {{ $view->AccommodationCost ? number_format($view->AccommodationCost, 2) : 'Not Specified' }}
                        </p>
                        <p>Daily allowance: ₱
                            {{ $view->DailyAllowance ? number_format($view->DailyAllowance, 2) : 'Not Specified' }}</p>
                        <p>Conference Registration Fee:
                            {{ $view->ConferenceRegistrationFee ? number_format($view->ConferenceRegistrationFee, 2) : 'Not Specified' }}
                        </p>
                        <p>Visa Documentation Fee: ₱
                            {{ $view->VisaDocumentation ? number_format($view->VisaDocumentation, 2) : 'Not Specified' }}
                        </p>
                        <p>Travel insurance: ₱
                            {{ $view->TravelInsurance ? number_format($view->TravelInsurance, 2) : 'Not Specified' }}</p>
                        <p>Miscellaneous: ₱
                            {{ $view->MiscellaneousExpenses ? number_format($view->MiscellaneousExpenses, 2) : 'Not Specified' }}
                        </p>
                        <p>Total Estimated Amount: ₱
                            {{ $view->TotalEstimatedBudget ? number_format($view->TotalEstimatedBudget, 2) : 'Not Specified' }}
                        </p>
                    </div>
                </div>
                <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Approve Request</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form
                                    action="{{ route(strtolower($role) . '.new.travel-update', ['RequestID' => $view->RequestID]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <p class="txt-danger">Make sure to have read all the neccessary informations</p>
                                    <div class="row ">
                                        <div class="col ">
                                            <input type="text" name="Status" value="Approved" hidden>
                                            <input type="text" name="ApprovedBy" value="{{ $name }}" hidden>
                                            <input type="text" name="DateApproved" value="{{ date('Y-m-d') }}" hidden>
                                            <div class="col-12  mb-3">
                                                <label>Leave a Note</label>
                                                <x-text-area label="Notes" name="Notes" rows="3" />
                                            </div>
                                            <button class="btn btn-primary text-end" type="submit">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reject Request</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form
                                    action="{{ route(strtolower($role) . '.new.travel-update', ['RequestID' => $view->RequestID]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <p class="txt-danger">Make sure to have read all the neccessary informations</p>
                                    <div class="row">
                                        <div class="col ">
                                            <input type="text" name="Status" value="Rejected" hidden>
                                            <input type="text" name="ApprovedBy" value="{{ $name }}" hidden>
                                            <input type="text" name="DateApproved" value="{{ date('Y-m-d') }}" hidden>
                                            <div class="col-12  mb-3">
                                                <label>Leave a Note</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea4" rows="3" name="notes" required></textarea>
                                            </div>
                                            <button class="btn btn-primary text-end" type="submit">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="revise" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Revise Travel Request</h4>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form
                                    action="{{ route(strtolower($role) . '.new.travel-revise', ['RequestID' => $view->RequestID]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form theme-form">
                                        <div class="row g-3 mb-3">
                                            <div class="col-12">
                                                <x-input-text label="Title" name="Title" value="{{ $view->Title }}"
                                                    readonly />
                                            </div>
                                            <div class="col-12">
                                                <x-input-text label="Destination" name="Destination"
                                                    value="{{ $view->Destinations }}" readonly />
                                            </div>
                                            <div class="col-12">
                                                <x-input-peso label="Total Estimated Budget" name="TotalEstimatedBudget"
                                                    value="{{ $view->TotalEstimatedBudget }}" />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label"> Approval Status</label>
                                                <select class="form-select" name="Status" required="">
                                                    <option value="{{ $view->Status }}">{{ $view->Status }}
                                                    </option>
                                                    <option value="Approved">Approve</option>
                                                    <option value="Rejected">Reject</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <input type="text" name="Status" value="rejected" hidden>
                                                <input type="text" name="ApprovedBy" value="{{ $name }}"
                                                    hidden>
                                                <input type="text" name="DateApproved" value="{{ date('Y-m-d') }}"
                                                    hidden>
                                                <x-text-area label="Notes" name="Notes" rows="3" />
                                            </div>
                                        </div>
                                        <x-button class="btn w-100 btn-outline-primary" type="submit" name="Revise"/>
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
        setTimeout(function() {
            $('.alert-float').fadeOut();
        }, 2000);

        $('.alert-float').css({
            position: 'fixed',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            zIndex: 9999 // Ensure it floats above other elements
        });
    </script>
@endsection

@section('script')
    <!-- Validation JS -->
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
