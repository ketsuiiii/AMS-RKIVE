@php
    $user = auth()->user();
    $name = $user->first_name . ' ' . $user->last_name;
    $role = $user->role->role_name;
    // dd($requests);
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
    <li class="breadcrumb-item active">Request</li>
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
                        <div class="card-header-right mb-2">
                            <a href="{{ route('' . strtolower($role) . '.new.addbudget.create') }}"
                                class="btn btn-outline-primary">Create</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('' . strtolower($role) . '.new.addbudget.search') }}" method="get"
                            class="d-flex justify-content-end mb-3">
                            @csrf
                            <label for="search" class="visually-hidden">Search</label>
                            <div class="input-group">
                                <input type="text" class="form-control w-25" name="search" placeholder="Search">
                                <button type="submit" class="btn btn-outline-primary"><i class="icon-search"></i></button>
                            </div>
                        </form>
                        <div class="card">
                            <div class="card-body">
                                <span class="text-danger"><b>Note: </b></span>If you see a request that has a <b>requestor
                                    email</b>, it means that the request has been sent to the via API. After sending the
                                request, it will be receive a copy of this
                                request. They will also be notified via email if the status is changed.
                            </div>
                        </div>
                        <x-alert />
                        @forelse ($requests as $item)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>Code</b> : {{ $item->request_code }} <br>
                                            <b>Request Name</b> : {{ $item->request_name }} <br>
                                            <b>Requestor</b> :
                                            @if ($item->request_revisedBy != null)
                                                {{ $item->request_revisedBy }}
                                            @else
                                                {{ $item->request_createdBy }}
                                            @endif
                                            <br>
                                            @if ($item->request_email != null)
                                                <b>Requestor Email</b> : {{ $item->request_email }} <br>
                                            @endif
                                            <b>Department</b> : {{ $item->department->department_name }} <br>
                                            <b>Category</b> : {{ $item->category->category_name }} <br>
                                            <b>Amount</b> : &#8369; {{ number_format($item->request_amount, 2) }} <br>
                                            <b>Project Details Name</b> : {{ $item->budget->budget_name ?? 'N/A' }}
                                            <br>
                                            <b>Budget Amount</b> :
                                            {{ number_format($item->budget->budget_amount, 2) ?? 'N/A' }} <br>
                                            <b>Period</b> : {{ $item->periods->period_name }} <br>
                                            <b>Actual Spend</b> : &#8369;
                                            {{ number_format($item->request_actualSpending, 2) }} <br>
                                            <b>Justification</b> : {{ $item->request_justification }} <br>
                                            <b>Supporting Document</b> : Yes <br>
                                            <b>Additional Document</b> : {{ $item->optional->optional_name }} <br>
                                        </div>

                                        <div class="col-md-6">
                                            <form action="{{ route('' . strtolower($role) . '.new.addbudget.search') }}"
                                                method="get" class="mb-2">
                                                @csrf
                                                @if ($item->status->status_name == 'Approved')
                                                    <button type="submit" name="search" value="S1"
                                                        class="btn btn-sm btn-pill btn-outline-success">
                                                        <b>Status</b>:
                                                        {{ $item->status->status_name ?? 'N/A' }}</button><br>
                                                @elseif ($item->status->status_name == 'Rejected')
                                                    <button type="submit" name="search" value="S3"
                                                        class="btn btn-sm btn-pill btn-outline-danger">
                                                        <b>Status</b>:
                                                        {{ $item->status->status_name ?? 'N/A' }}</button><br>
                                                @else
                                                    <button type="submit" name="search" value="S2"
                                                        class="btn btn-sm btn-pill btn-outline-warning">
                                                        <b>Status</b>:
                                                        {{ $item->status->status_name ?? 'N/A' }}</button><br>
                                                @endif
                                            </form>
                                            <b>Approver</b>: {{ optional($item->approvedBy)->first_name ?? 'N/A' }}
                                            {{ optional($item->approvedBy)->last_name ?? '' }} <br>
                                            <b>Date</b>: {{ $item->request_approvedDate ?? 'N/A' }} <br>
                                            <b>Amount</b>: ₱
                                            {{ number_format($item->request_approvedAmount, 2) ?? '0.00' }} <br>
                                            <b>Notes</b>: {{ $item->request_notes ?? 'N/A' }} <br>
                                            <br>

                                            @if ($role == 'Admin')
                                                <a class="btn btn-outline-primary w-100"
                                                    href="{{ route(strtolower($role) . '.new.addbudget.edit', ['id' => $item->id]) }}">View</a>
                                            @else
                                                <a class="btn btn-outline-primary w-100"
                                                    href="{{ route('employee.new.addbudget.edit', ['id' => $item->id]) }}">View</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('assets/images/void.svg') }}"
                                        style="min-height:200px; max-height:200px" alt=""><br> <br>
                                    <span>No Record Found</span>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
    <x-sort-script />
    <x-sort-style />
@endsection

@section('script')
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
