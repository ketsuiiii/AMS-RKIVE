@php
    $user = auth()->user();
    $name = $user->first_name . ' ' . $user->last_name;
    $role = $user->role->role_name;

    $logs = [];
    if (isset($user)) {
        if ($user->role->role_name == 'Admin') {
            $logs = DB::table('g59_logs')->get();
        } elseif ($user->role->role_name == 'Employee') {
            $logs = DB::table('g59_logs')
                ->where('user_id', $user->username)
                ->get();
        }
    }
    // dd($logs);
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
    <h3>{{ $role }} Logs</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item active">Logs</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $role }} Logs</h5>
                    </div>
                    <div class="card-body">
                        @if (count($logs) > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Message</th>
                                            <th>Date</th>
                                            @if ($user->role->role_name == 'Admin')
                                                <th>Action From</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logs as $item)
                                            @if ($item->status == 'success')
                                                <tr>
                                                    <td class="text-success">{{ $item->message }}</td>
                                                    <td class="text-success">{{ $item->created_at }}</td>
                                                    @if ($user->role->role_name == 'Admin')
                                                        <td class="text-success">{{ $item->user_id }}</td>
                                                    @endif
                                                </tr>
                                            @elseif ($item->status == 'multi-error')
                                                @php
                                                    $message = json_decode($item->message, true);

                                                    $formattedMessages = [];

                                                    foreach ($message as $key => $value) {
                                                        $formattedMessages[] = "- $key: $value[0]";
                                                    }

                                                    $formattedMessage = nl2br(implode("\n", $formattedMessages));
                                                @endphp
                                                <tr>
                                                    <td class="text-danger">{{ $formattedMessage }}</td>
                                                    <td class="text-danger">{{ $item->created_at }}</td>
                                                    @if ($user->role->role_name == 'Admin')
                                                        <td class="text-danger">{{ $item->user_id }}</td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center">
                                No Logs Found
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="account" tabindex="-1" aria-labelledby="accountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountLabel">Account Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Email: <b>daniel@gmail.com</b></p>
                    <p>Password: <b>admin123</b></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
