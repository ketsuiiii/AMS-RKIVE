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
    <li class="breadcrumb-item">{{ ucfirst($role) }}</li>
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Details</li>
@endsection

@section('content')

    @if ($role == 'Admin')
        <livewire:admin.dashboard :user="$user" />
    @else
        <livewire:user.dashboard :user="$user" />
    @endif

    <x-notify />

    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>

@endsection

@section('script')


    <!-- bootstrap notify js -->
    <script src="../assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="../assets/js/notify/notify-script.js"></script>
@endsection
