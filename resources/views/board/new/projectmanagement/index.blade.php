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

@section('breadcrumb-title')
    <h3>Project Management Request</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item">Project Management</li>
    <li class="breadcrumb-item active">Requests</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <h5>Rkive Travel Management</h5>
                        </div>
                        <div class="card-header-right">
                            <form action="{{ route(strtolower($role) . '.new.project.search') }}" method="get"
                                class="d-flex justify-content-end mb-3">
                                @csrf
                                <label for="search" class="visually-hidden">Search</label>
                                <div class="input-group">
                                    <input type="text" class="form-control w-25" name="search" placeholder="Search">
                                    <button type="submit" class="btn btn-outline-primary"><i
                                            class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-alert />
                        <div class="table-responsive">
                            <div class="table-container">
                                <table class="table">
                                    <thead class="text-center">=
                                        <tr>
                                            <th class="sortable">ID</th>
                                            <th class="sortable">ProjectID</th>
                                            <th class="sortable">Supplier</th>
                                            <th class="sortable">Inventory</th>
                                            <th class="sortable">SubContractor</th>
                                            <th class="sortable">Budget</th>
                                            <th class="sortable">Facility</th>
                                            <th class="sortable">Contract</th>
                                            <th class="sortable">Risk</th>
                                            {{--
                                            <th class="sortable">Active</th>
                                            <th class="sortable">Status</th> --}}
                                            <th class="sortable">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($error))
                                            <tr>
                                                <td colspan="18" class=" text-center">
                                                    {{ $error }}
                                                </td>
                                            </tr>
                                        @else
                                            @forelse ($management as $item)
                                                <tr class="text-center">

                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->project_id }}</td>
                                                    <td>{{ $item->supplier_vendor }}</td>
                                                    <td>{{ $item->asset_inventory }}</td>
                                                    <td>{{ $item->subcontractor }}</td>
                                                    <td>₱{{ $item->budgeting_financial }}</td>
                                                    {{-- <td>{{ number_format($item->budgeting_financial, 2) }}</td> --}}
                                                    <td>{{ $item->facility_management }}</td>
                                                    <td>{{ $item->legal_contract }}</td>
                                                    <td>{{ $item->risk }}</td>
                                                    {{-- <td>{{ $item->is_active }}</td>
                                                    <td>{{ $item->is_approved }}</td> --}}
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $item->id }}">
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route(strtolower($role) . '.new.project.update', ['id' => $item->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <div class="row g-3">
                                                                        {{-- <div class="col-md-12">
                                                                            <select name="is_approved" id=""
                                                                                class="form-select">
                                                                                <option value="1">Approve</option>
                                                                                <option value="0">Reject</option>
                                                                            </select>
                                                                        </div> --}}
                                                                        <div class="col-md-12">
                                                                            <x-input-peso name="budget" label="Amount" />
                                                                        </div>
                                                                        <!--<div class="col-md-12">-->
                                                                        <!--    <div class="form-check">-->
                                                                        <!--        <div class="checkbox p-0">-->
                                                                        <!--            <input type="checkbox" id="terms"-->
                                                                        <!--                name="terms"-->
                                                                        <!--                class="form-check-input" />-->
                                                                        <!--            <label class="form-check-label"-->
                                                                        <!--                for="terms">Agree to terms and-->
                                                                        <!--                conditions</label>-->
                                                                        <!--        </div>-->
                                                                        <!--    </div>-->
                                                                        <!--    <span class="text-danger">-->
                                                                        <!--        @error('terms')-->
                                                                        <!--            {{ $message }}-->
                                                                        <!--        @enderror-->
                                                                        <!--    </span>-->
                                                                        <!--</div>-->
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <tr>
                                                    <td colspan="18" class=" text-center">
                                                        No Record Found
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
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
