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
    <script src="{{ asset('assets/js/chart/echart/echart-5-4-3.js') }}"></script>
@endsection

@section('style')

@endsection

@section('breadcrumb-title')
    <h3>{{ $role }} Annual Budget</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item">Balance</li>
    <li class="breadcrumb-item active">Request</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="container-fluid mt-4">
                    <div class="row">
                        <!-- Budget Per Department -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Budget Per Department</h5>
                                    <div id="budgetPerDepartment" style="width: 100%; height: 500px;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Budget requests per Department -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Budget Requests Per Department</h5>
                                    <div id="budgetRequestsPerDepartment" style="width: 100%; height: 500px;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Budget requests per Department and Budget per Department -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Budget Requests Per Department and Budget Per Department</h5>
                                    <div id="budgetRequestsPerDepartmentAndBudgetPerDepartment"
                                        style="width: 100%; height: 500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function getRandomColor() {
                            var colors = ['#7366FF', '#FF3364'];
                            return colors[Math.floor(Math.random() * colors.length)];
                        }

                        function removeFloatAndCommas(number) {
                            return parseInt(number.replace(/[,\.]/g, ''));
                        }

                        function getRandomColors(count) {
                            var colors = [];
                            var letters = '0123456789ABCDEF';
                            for (var j = 0; j < count; j++) {
                                var color = '#';
                                for (var i = 0; i < 6; i++) {
                                    color += letters[Math.floor(Math.random() * 16)];
                                }
                                colors.push(color);
                            }
                            return colors;
                        }

                        // Get random color
                        var randomColor = getRandomColor();
                        var randomColors = getRandomColors(10);

                        // Get New data from Laravel
                        var budgetPerDepartmentData = @json($budgetPerDepartmentData);
                        var budgetRequestsPerDepartmentData = @json($budgetRequestsPerDepartmentData);

                        // Initiate New Charts
                        var budgetPerDepartmentChart = echarts.init(document.getElementById('budgetPerDepartment'));
                        var budgetRequestsPerDepartmentChart = echarts.init(document.getElementById('budgetRequestsPerDepartment'));
                        var budgetRequestsPerDepartmentAndBudgetPerDepartmentChart = echarts.init(document.getElementById(
                            'budgetRequestsPerDepartmentAndBudgetPerDepartment'));

                        // Budget per Department Chart
                        var budgetPerDepartmentXAxisData = @json($budgetPerDepartmentData->pluck('department_name')->toArray());
                        var budgetPerDepartmentSeriesData = @json($budgetPerDepartmentData->pluck('budget_approvedAmount')->toArray());

                        var budgetPerDepartmentOption = {
                            color: [randomColor],
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis: [{
                                type: 'category',
                                data: budgetPerDepartmentXAxisData,
                                axisTick: {
                                    alignWithLabel: true
                                }
                            }],
                            yAxis: [{
                                type: 'value'
                            }],
                            series: [{
                                name: 'Budget (PHP)',
                                type: 'bar',
                                barWidth: '60%',
                                data: budgetPerDepartmentSeriesData
                            }]
                        };

                        budgetPerDepartmentChart.setOption(budgetPerDepartmentOption);

                        // Add Budget per Department Chart
                        var addBudgetPerDepartmentXAxisData = @json($budgetRequestsPerDepartmentData->pluck('department_name')->toArray());
                        var addBudgetPerDepartmentSeriesData = @json($budgetRequestsPerDepartmentData->pluck('request_approvedAmount')->toArray());

                        var addBudgetPerDepartmentOption = {
                            color: [randomColor],
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis: [{
                                type: 'category',
                                data: addBudgetPerDepartmentXAxisData,
                                axisTick: {
                                    alignWithLabel: true
                                }
                            }],
                            yAxis: [{
                                type: 'value'
                            }],
                            series: [{
                                name: 'Budget (PHP)',
                                type: 'bar',
                                barWidth: '60%',
                                data: addBudgetPerDepartmentSeriesData
                            }]
                        };

                        budgetRequestsPerDepartmentChart.setOption(addBudgetPerDepartmentOption);

                        // Budget per Department Chart
                        var budgetPerDepartmentXAxisData = @json($budgetPerDepartmentData->pluck('department_name')->toArray());
                        var budgetPerDepartmentSeriesData = @json($budgetPerDepartmentData->pluck('budget_approvedAmount')->toArray());

                        // Add Budget per Department Chart
                        var budgetRequestsPerDepartmentXAxisData = @json($budgetRequestsPerDepartmentData->pluck('department_name')->toArray());
                        var budgetRequestsPerDepartmentSeriesData = @json($budgetRequestsPerDepartmentData->pluck('request_approvedAmount')->toArray());

                        var perDepartmentOption = {
                            color: randomColors,


                            tooltip: {
                                trigger: 'axis',
                                axisPointer: {
                                    type: 'shadow'
                                }
                            },
                            legend: {},
                            grid: {
                                left: '3%',
                                right: '4%',
                                bottom: '3%',
                                containLabel: true
                            },
                            xAxis: {
                                type: 'value',
                                boundaryGap: [0, 0.01]
                            },
                            yAxis: {
                                type: 'category',
                                data: budgetPerDepartmentXAxisData
                            },
                            series: [{
                                    name: 'Actual (PHP)',
                                    type: 'bar',
                                    data: budgetRequestsPerDepartmentSeriesData
                                },
                                {
                                    name: 'Budget (PHP)',
                                    type: 'bar',
                                    data: budgetPerDepartmentSeriesData
                                }
                            ]
                        };

                        budgetRequestsPerDepartmentAndBudgetPerDepartmentChart.setOption(perDepartmentOption);
                    </script>
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
