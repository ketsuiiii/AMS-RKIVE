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
    <h3>{{ $role }} Travel Expenses</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Travel</li>
    <li class="breadcrumb-item active">Expenses</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            Travel Expense Breakdown
                        </div>
                        <div class="card-body justify-content-center">
                            <div id="chart-container" style="width: 100%; height: 400px;" class="mb-3 p-2"></div>
                            <div class="rounded p-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Expense</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Total Transportation</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalTransportationCost, 2) }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Accommodation</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalAccommodationCost, 2) }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Meal</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalMeals, 2) }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Daily Allowance</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalDailyAllowance, 2) }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Conference Registration Fee</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalConferenceRegistrationFee, 2) }}
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Visa Documentation Fee</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalVisaDocumentationFee, 2) }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Travel Insurance</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalTravelInsuranceCost, 2) }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Miscellaneous</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalMiscellaneousExpenses, 2) }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Estimated Budget</th>
                                            <td>
                                                <ul>
                                                    <li>₱{{ number_format((float) $totalEstimatedBudget, 2) }}</li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3 class="mb-3">Travel Expenses</h3>
                        <p>Quick Overview, click the view button to review the complete breakdown</p>
                        <x-alert />
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-container">
                                <table class="table">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="sortable">Travel Request ID</th>
                                            <th class="sortable">Name</th>
                                            <th class="sortable">Total Transportation</th>
                                            <th class="sortable">Total Accommodation</th>
                                            <th class="sortable">Total Meal</th>
                                            <th class="sortable">Total Other Expenses</th>
                                            <th class="sortable">Review</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($groupedExpenses as $expense)
                                            <tr>
                                                <td>{{ $expense->RequestID }}</td>
                                                <td>Name</td>
                                                <td>₱ {{ number_format($expense->totalTransportationCost, 2) }}</td>
                                                <td>₱ {{ number_format($expense->totalAccommodationCost, 2) }}</td>
                                                <td>₱ {{ number_format($expense->totalMeals, 2) }}</td>
                                                <td>₱ {{ number_format($expense->totalEstimatedBudget, 2) }}</td>

                                                <td>
                                                    <a href="{{ route(strtolower($role) . '.new.travel-expenses-view', ['RequestID' => $expense->RequestID]) }}"
                                                        class="btn btn-primary">View</a>
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
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
        var chart = echarts.init(document.getElementById('chart-container'));
        var option = {
            // title: {
            //     text: 'Travel Expense Breakdown'
            // },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} PHP ({d}%)'
            },
            legend: {
                data: ['Transportation', 'Accommodation', 'Meal', 'Miscellaneous', 'Conference Registration Fee',
                    'Visa Documentaion Fee', 'Travel Insurance'
                ]
            },
            series: [{
                name: 'Expenses',
                type: 'pie',
                radius: '80%',
                center: ['50%', '60%'],
                data: [{
                        value: {{ $totalTransportationCost }},
                        name: 'Transportation'
                    },
                    {
                        value: {{ $totalAccommodationCost }},
                        name: 'Accommodation'
                    },
                    {
                        value: {{ $totalMeals }},
                        name: 'Meal'
                    },
                    {
                        value: {{ $totalMiscellaneousExpenses }},
                        name: 'Miscellaneous'
                    },
                    {
                        value: {{ $totalConferenceRegistrationFee }},
                        name: 'Conference Registration Fee'
                    },
                    {
                        value: {{ $totalVisaDocumentationFee }},
                        name: 'Visa Documentaion Fee'
                    },
                    {
                        value: {{ $totalTravelInsuranceCost }},
                        name: 'Travel Insurance'
                    }
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }],
            grid: {
                left: '5%',
                right: '5%',
                top: '15%',
                bottom: '15%'
            },
        };
        chart.setOption(option);
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/echart/echart-5-4-3.js') }}"></script>
    <!-- Validation JS -->
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
    <!-- Datepicker JS -->
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
@endsection
