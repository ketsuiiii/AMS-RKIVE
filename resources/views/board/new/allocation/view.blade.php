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
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ $role }} Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item">Allocation</li>
    <li class="breadcrumb-item active">Department</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Cost Allocation</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card o-hidden welcome-card"
                                style="background: rgb(2,0,36);
                         background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
                                <div class="card-body">
                                    <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22"><span> <img
                                                src="https://fbs.rkiveadmin.com/rkive-travels/assets/images/dashboard/hand.svg"
                                                alt="hand vector"></span>{{ $department }} </h4>
                                    <h3 class="f-w-400">Remaining Balance:
                                        ₱{{ number_format($remaining, 2) }} </h3>
                                    <h5 class="f-w-400">Total Budget: ₱ {{ number_format($allocate, 2) }} </h5>

                                </div><img class="welcome-img"
                                    src="https://fbs.rkiveadmin.com/travel-portal/assets/images/dashboard/widget.svg"
                                    alt="search image">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5>Cost Breakdown</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($breakdown->groupBy('track_date') as $date => $items)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>{{ $date }}</h5>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($items as $item)
                                                        <tr>
                                                            <td>{{ $item->category->category_name }}</td>
                                                            <td>₱{{ number_format($item->track_amount, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
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
