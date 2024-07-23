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
    <li class="breadcrumb-item">Expense</li>
    <li class="breadcrumb-item active">Request</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-left">
                            <h3 class="">Expense Request Table</h3>
                        </div>
                        <div class="card-header-right">
                            <form action="{{ route(strtolower($role) . '.new.finance.expenseSearch') }}" method="get"
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
                    <div class="card-body">
                        <x-alert />
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Admin Status</th>
                                        <th>Admin Budget</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budgetData as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ $item['date'] }}</td>
                                            <td>₱ {{ number_format($item['amount'], 2) }}</td>
                                            <td>{{ $item['category'] }}</td>
                                            <td>{{ $item['description'] }}</td>
                                            <td>{{ $item['admin_status'] ? $item['admin_status'] : 'Pending' }}</td>
                                            <td>₱ {{ number_format($item['admin_budget'], 2) }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item['id'] }}">
                                                    View
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $item['id'] }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Budget
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route(strtolower($role) . '.new.finance.expenseUpdate', $item['id']) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row g-3">
                                                                        <input type="text" name="id"
                                                                            value="{{ $item['id'] }}" hidden>
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Status</label>
                                                                            <select name="status" id=""
                                                                                class="form-select">
                                                                                <option value="{{ $item['status'] }}">
                                                                                    {{ $item['status'] }}</option>
                                                                                <option value="Approved">Approved</option>
                                                                                <option value="Rejected">Rejected</option>
                                                                            </select>
                                                                            <span class="text-danger">
                                                                                @error('status')
                                                                                    {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <x-input-peso label="Amount" name="budget" />
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="col-md-12">
                                                                                <x-button type="button" class="w-100 btn-outline-primary"
                                                                                    name="Save" data-bs-toggle="modal"
                                                                                    data-bs-target="#termsModal{{ $item['id'] }}" />
                                                                                <x-checkbox-auth :value="$item['id']" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
