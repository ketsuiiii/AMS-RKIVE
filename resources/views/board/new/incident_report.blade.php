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
    <h3>{{ $role }} Incident Report</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">{{ $role }}</li>
    <li class="breadcrumb-item active">Incident Report</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Add Incident</h5>
                                </div>
                                <div class="card-body">
                                    <x-alert />
                                    <form method="post" action="{{route(strtolower($role).'.new.incident.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="owner">Owner</label>
                                                <input class="form-control" id="owner" type="text"
                                                    placeholder="Owner" name="owner" required="">
                                                <div class="invalid-feedback">Please provide the owner.</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="title">Title</label>
                                                <input class="form-control" id="title" type="text"
                                                    placeholder="Title" name="title" required="">
                                                <div class="invalid-feedback">Please provide the title.</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="importance">Importance</label>
                                                <select class="form-select" id="importance" name="importance"
                                                    required="">
                                                    <option value="" selected disabled>Select Importance</option>
                                                    <option value="Low">Low</option>
                                                    <option value="Medium">Mid</option>
                                                    <option value="High">High</option>
                                                </select>
                                                <div class="invalid-feedback">Please provide the importance.</div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label" for="description">Description</label>
                                                <textarea class="form-control" id="description" placeholder="Description" name="description" required=""></textarea>
                                                <div class="invalid-feedback">Please provide the description.</div>
                                            </div>
                                        </div>
                                        <br>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h5>Incident Report</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive signal-table">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Owner</th>
                                                <th>Title</th>
                                                <th>Importance</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Team Personnel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['incident'] as $incident)
                                                <tr>
                                                    <th scope="row">{{ $incident['id'] }}</th>
                                                    <td>{{ $incident['owner'] }}</td>
                                                    <td>{{ $incident['title'] }}</td>
                                                    <td>{{ $incident['importance'] }}</td>
                                                    <td>{{ $incident['description'] }}</td>
                                                    <td>{{ $incident['status'] }}</td>
                                                    <td>
                                                        @foreach ($data['personnels'] as $item)
                                                            @if ($item['id'] == $incident['team_personnel_id'])
                                                                {{ $item['name'] }}
                                                            @endif
                                                        @endforeach
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
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
@endsection
