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
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ $role }} Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Department</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Department</h5>
                    </div>
                    <div class="card-body">
                        <x-alert />
                        <form action="{{ route('deptPost') }}" method="POST">
                            @csrf
                            <div class="col-md-12 mb-3">
                                <x-input-text label="Department Name" name="department_name" />
                            </div>
                            {{-- Approved --}}
                            <div class="col-md-12">
                                <x-button type="button" class="w-100 btn-outline-primary" name="Save"
                                    data-bs-toggle="modal" data-bs-target="#termsModal0" />
                                <x-checkbox-auth :value="0" />
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Department List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Department Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($department as $dept)
                                    <tr>
                                        <th scope="row">{{ $dept->department_code }}</th>
                                        <td>{{ $dept->department_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
