@extends('layouts.custom.auth')
@section('title', 'Login an account')

@section('css')

@endsection

@section('style')
    <style>
        .right {
            background-color: #dde0fc;
        }

        .left {
            background-color: #312B70;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg fill-opacity='0.99'%3E%3Cpolygon fill='%232c2765' points='1600 160 0 460 0 350 1600 50'/%3E%3Cpolygon fill='%23272259' points='1600 260 0 560 0 450 1600 150'/%3E%3Cpolygon fill='%23211d4c' points='1600 360 0 660 0 550 1600 250'/%3E%3Cpolygon fill='%231a163b' points='1600 460 0 760 0 650 1600 350'/%3E%3Cpolygon fill='%230F0D22' points='1600 800 0 800 0 750 1600 450'/%3E%3C/g%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;
        }


        .left div {
            margin: 20% 10%;
        }

        .card {
            width: 400px;
        }

        @media (max-width: 700px) {
            .card {
                width: 70%;
            }
        }

        #logo {
            height: 100px;
            width: auto;
            margin: 0;
            /* Set initial position */
            transform: translateY(0);
            /* Define the animation */
            animation: mover 2s infinite alternate;
        }

        #mode {
            height: 75px;
            width: auto;
            margin: 0;
        }

        @keyframes mover {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        @media (max-width: 576px) {

            /* Small screens (sm) */
            h4 {
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {

            /* Medium screens (md) */
            h4 {
                font-size: 16px;
            }

            .right {
                background-color: #312B70;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg fill-opacity='0.99'%3E%3Cpolygon fill='%232c2765' points='1600 160 0 460 0 350 1600 50'/%3E%3Cpolygon fill='%23272259' points='1600 260 0 560 0 450 1600 150'/%3E%3Cpolygon fill='%23211d4c' points='1600 360 0 660 0 550 1600 250'/%3E%3Cpolygon fill='%231a163b' points='1600 460 0 760 0 650 1600 350'/%3E%3Cpolygon fill='%230F0D22' points='1600 800 0 800 0 750 1600 450'/%3E%3C/g%3E%3C/svg%3E");
                background-attachment: fixed;
                background-size: cover;
            }
        }
    </style>

@endsection

@section('content')
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-body-wrapper">
            <div class="container-fluid p-0">
                <div class="row m-0">
                    <div class="col-6 left d-none d-md-block d-sm-none text-white">
                        <div>
                            <img src="{{ asset('assets/images/logo/logo1.png') }}" alt="" id="logo">
                            <h1>Rkive</h1>
                            <h4 class="d-lg-none">Administrative Solutions</h4>
                            <p>Your administrative needs in one place</p>
                        </div>
                    </div>

                    <div class="col p-0 right">
                        <div class="login-card">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header-left">
                                        <h2>Login</h2>
                                    </div>
                                    <div class="card-header-right">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Help
                                    </button>
                                </div>
                                <span class="text-danger">Make to check the spelling of your credentials. Use an case sensitive characters</span>
                                </div>
                                <div class="card-body">
                                    <x-alert />
                                    <form action="{{ route('loginPost') }}" method="POST">
                                        @csrf
                                        <div class="row g-2 mb-3">
                                            <div class="col-md-12">
                                                <x-input-text label="Username" name="username_or_email" />
                                            </div>
                                            <div class="col-md-12">
                                                <x-input-password label="Password" name="password" />
                                            </div>
                                        </div>
                                        <x-button type="submit" class="w-100 btn-outline-primary" name="Login" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Need Help?</h5>
                </div>
                <div class="modal-footer">
                    <div class="row g-3">
                        <div class="col-md-12 col-sm-12">
                            <div class="mode"> <a class="btn btn-info w-100">Change Mode</a> </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <a class="btn btn-secondary w-100" href="{{ route('resetForm') }}">Forgot Password</a>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <a class="btn btn-primary w-100" href="{{ route('helpdesk') }}">Help Desk</a>
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
