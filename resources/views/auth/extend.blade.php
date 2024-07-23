@extends('layouts.custom.auth')
@section('title', 'Access Denied')

@section('css')
@endsection

@section('style')
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .centered-div {
            /* width: 200px; */
            /* height: 200px; */
            /* line-height: 200px; */
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card centered-div">
                    <div class="card-body">
                        <form action="{{ route('loginPost') }}" method="POST">
                            @csrf
                            <div style="display: none">
                                <x-input-text label="Username" name="username_or_email" value="{{ $username_or_email }}" />
                                <x-input-password label="Password" name="password" value="{{ $password }}" />
                            </div>
                            <div class="text-center">
                                <i data-feather="lock" class="icon" style="width: 100px; height: 100px"></i>
                                <h2>Are you still there?</h2>
                                <p class="text-danger">You have been inactive for too long. Press the button below to extend your session.</p>
                                <x-button type="submit" class="w-100 btn-outline-primary" name="Extend Session" />
                            </div>
                        </form>
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
