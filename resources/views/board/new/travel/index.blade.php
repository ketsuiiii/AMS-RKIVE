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
    <!-- Datepicker CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
@endsection

@section('style')

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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <h3 class="">Rkive Travel Management</h3>
                        </div>
                        <div class="card-header-right">
                            <form action="{{ route(strtolower($role) . '.new.travel-search') }}" method="get"
                                class="d-flex justify-content-end mb-3">
                                @csrf
                                <label for="search" class="visually-hidden">Search</label>
                                <div class="input-group">
                                    <input type="text" class="form-control w-25" name="search" placeholder="Search">
                                    <button type="submit" class="btn btn-primary"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <x-alert />
                    <div class="card-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6 text-end">

                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="table-container">
                                <table class="table">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="sortable">ID</th>
                                            <th class="sortable">Name</th>
                                            <th class="sortable">Amount</th>
                                            <th class="sortable">Title</th>
                                            <th class="sortable">Purpose</th>
                                            <th class="sortable">Destination</th>
                                            <th class="sortable">Start</th>
                                            <th class="sortable">End</th>
                                            <th class="sortable">Attachments</th>

                                            <th class="sortable">Status</th>
                                            <th class="sortable">Approver</th>
                                            <th class="sortable">Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($travels as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->RequestID }}</td>
                                                <td>{{ $item->user->username }}</td>
                                                <td>₱{{ number_format((float) $item->TotalEstimatedBudget, 2) }}</td>
                                                <td>{{ $item->Title }}</td>
                                                <td>{{ $item->PurposeOfTravel }}</td>
                                                <td>{{ $item->Destinations }}</td>
                                                <td>{{ $item->StartDate }}</td>
                                                <td>{{ $item->EndDate }}</td>
                                                <td>{{ $item->Attachments }}</td>
                                                <td>{{ $item->Status }}</td>
                                                <td>{{ $item->ApprovedBy }}</td>
                                                <td> <a href="{{ route(strtolower($role) . '.new.travel-view', ['RequestID' => $item->RequestID]) }}"
                                                        class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="18" class="text-center">
                                                    <b>No Data Found</b>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-sort-script />
    <x-sort-style />
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
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
