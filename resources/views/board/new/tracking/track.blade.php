@php
    $user = auth()->user();
    $name = $user->first_name . ' ' . $user->last_name;
    $role = $user->role->role_name;
    // dd($data['department']);
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
    <h3>Annual Budget Plan</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Tracker</li>
    <li class="breadcrumb-item active">Budgets</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-md-4 col-lg-4">
                <div class="card text-white m-2"
                    style="background: rgb(2,0,36);
                background: linear-gradient(90deg, #6157FF 0%, #EE49FD 100%);">
                    <div class="card-body">
                        <h5>Company Budget</h5>
                        <h1>₱{{ number_format($allocate, 2) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="card text-white m-2"
                    style="background: rgb(2,0,36);
                      background: linear-gradient(90deg, #6157FF 0%, #EE49FD 100%);">
                    <div class="card-body">
                        <h5>Actual Spent</h5>
                        <h1>₱{{ number_format($spend, 2) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="card  text-white m-2"
                    style="background: rgb(2,0,36);
                 background: linear-gradient(90deg, #6157FF 0%, #EE49FD 100%);">
                    <div class="card-body">
                        <h5>Remaining Budget</h5>
                        <h1>₱{{ number_format($remaining, 2) }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="col-sm-12">
                    <div class="">
                        <div class="card-header p-3">
                            <h3 class="f-w-400">Requests Monitor</h3>
                        </div>
                        <div class="table-responsive signal-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Track no</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Budget</th>
                                        <th scope="col">Spending</th>
                                        <th scope="col">Remaining</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $item)
                                        <tr>
                                            <td><span class="unique-code"></span>{{ $item['budget']->id }}</td>
                                            <td>{{ $item['budget']->budget_name }}</td>
                                            <td>
                                                @foreach ($departments as $dept)
                                                    @if ($dept->department_code == $item['department'])
                                                        {{ $dept->department_name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>₱{{ number_format($item['budget']->budget_approvedAmount, 2) }}</td>
                                            <td>
                                                @if ($item['expenses'] > 0)
                                                    <span class="text-success">
                                                        ₱{{ number_format($item['expenses'], 2) }}</span>
                                                @else
                                                    <span class="text-danger">
                                                        ₱{{ number_format($item['expenses'], 2) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item['remain'] > 0)
                                                    <span class="text-success">
                                                        ₱{{ number_format($item['remain'], 2) }}</span>
                                                @else
                                                    <span class="text-danger">
                                                        ₱{{ number_format($item['remain'], 2) }}</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ route(strtolower($role) . '.new.budgetPlanExpenses', ['id' => $item['budget']->id]) }}"
                                                    class="btn btn-outline-primary btn-square" data-bs-original-title=""
                                                    title="">Track
                                                    Expenses</a></td>
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
    <script>
        function generateUniqueCode(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const uniqueCodeElements = document.querySelectorAll('.unique-code');
            uniqueCodeElements.forEach(function(element) {
                element.textContent = generateUniqueCode(5);
            });
        });
    </script>

@endsection

@section('script')
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
