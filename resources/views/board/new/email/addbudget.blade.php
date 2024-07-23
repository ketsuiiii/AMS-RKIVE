@extends('layouts.custom.auth')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {{-- @dd($mailData['items']) --}}
                        <h1>{{ $mailData['title'] }}</h1>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class='fs-5'>
                                    <tr>
                                        <th colspan="2">Budget Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Code</b></td>
                                        <td>{{ $mailData['items']->request_code }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Request Name</b></td>
                                        <td>{{ $mailData['items']->request_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Requestor</b></td>
                                        <td>
                                            @if ($mailData['items']->request_revisedBy != null)
                                                {{ $mailData['items']->request_revisedBy }}
                                            @else
                                                {{ $mailData['items']->request_createdBy }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Department</b></td>
                                        <td>{{ $mailData['items']->department->department_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Category</b></td>
                                        <td>{{ $mailData['items']->category->category_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Amount</b></td>
                                        <td>&#8369; {{ number_format($mailData['items']->request_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Project Details Name</b></td>
                                        <td>{{ $mailData['items']->budget->budget_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Budget Amount</b></td>
                                        <td>
                                            {{ number_format($mailData['items']->request_amount, 2) ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Period</b></td>
                                        <td>{{ $mailData['items']->periods->period_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Actual Spend</b></td>
                                        <td>&#8369; {{ number_format($mailData['items']->request_actualSpending, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Justification</b></td>
                                        <td>{{ $mailData['items']->request_justification }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Supporting Document</b></td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td><b>Additional Document</b></td>
                                        <td>{{ $mailData['items']->optional->optional_name }}</td>
                                    </tr>
                                </tbody>
                                <br>
                                <thead class='fs-5'>
                                    <tr>
                                        <th colspan="2">Approval Details</th>
                                    </tr>
                                </thead>
                                @if ($mailData['items']->status->status_name == 'Approved')
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td class="text-success">
                                            {{ $mailData['items']->status->status_name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Approver</b></td>
                                        <td class="text-success">
                                            {{ optional($mailData['items']->approvedBy)->first_name ?? 'N/A' }}
                                            {{ optional($mailData['items']->approvedBy)->last_name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Date</b></td>
                                        <td class="text-success">{{ $mailData['items']->request_approvedDate ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Amount</b></td>
                                        <td class="text-success">
                                            ₱{{ number_format($mailData['items']->request_approvedAmount, 2) ?? '0.00' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Notes</b></td>
                                        <td class="text-success">
                                            {{ $mailData['items']->request_notes ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @elseif ($mailData['items']->status->status_name == 'Rejected')
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td class="text-danger">
                                            {{ $mailData['items']->status->status_name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Approver</b></td>
                                        <td class="text-danger">
                                            {{ optional($mailData['items']->approvedBy)->first_name ?? 'N/A' }}
                                            {{ optional($mailData['items']->approvedBy)->last_name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Date</b></td>
                                        <td class="text-danger">{{ $mailData['items']->request_approvedDate ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Amount</b></td>
                                        <td class="text-danger">
                                            ₱{{ number_format($mailData['items']->request_approvedAmount, 2) ?? '0.00' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Notes</b></td>
                                        <td class="text-danger">
                                            {{ $mailData['items']->request_notes ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td class="text-warning">
                                            {{ $mailData['items']->status->status_name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Approver</b></td>
                                        <td class="text-warning">
                                            {{ optional($mailData['items']->approvedBy)->first_name ?? 'N/A' }}
                                            {{ optional($mailData['items']->approvedBy)->last_name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Date</b></td>
                                        <td class="text-warning">{{ $mailData['items']->request_approvedDate ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Amount</b></td>
                                        <td class="text-warning">
                                            ₱{{ number_format($mailData['items']->request_approvedAmount, 2) ?? '0.00' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Notes</b></td>
                                        <td class="text-warning">
                                            {{ $mailData['items']->request_notes ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                                <br>
                                <tfoot class='fs-5'>
                                    <tr>
                                        <th colspan="2">Thank You for creating this budget request. You can track your
                                            request status by using the link below. We will send a email to you once your
                                            request is approved or rejected.</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <a href="{{ route('integration.track') }}"><b>Track your request</b></a>
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
