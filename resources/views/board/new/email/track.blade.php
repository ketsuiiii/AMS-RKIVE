@extends('layouts.custom.auth')

@section('title', 'Default')

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
                        <form action="{{ route('integration.search') }}" method="get"
                            class="d-flex justify-content-end mb-3">
                            @csrf
                            <label for="search" class="visually-hidden">Search</label>
                            <div class="input-group">
                                <input type="text" class="form-control w-25" name="search" placeholder="Search">
                                <button type="submit" class="btn btn-outline-primary"><i class="icon-search"></i></button>
                            </div>
                        </form>
                        <x-alert />
                        @if ($type == 'R1')
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <b>Budget Name</b> : {{ $requests[0]->budget_name }} <br>
                                        <b>Requestor</b> :
                                        @if ($requests[0]->budget_revisedBy != null)
                                            {{ $requests[0]->budget_revisedBy }}
                                        @else
                                            {{ $requests[0]->budget_createdBy }}
                                        @endif
                                        <br>
                                        @if ($requests[0]->budget_email != null)
                                            <b>Requestor Email</b> : {{ $requests[0]->budget_email }} <br>
                                        @endif
                                        <b>Department</b> : {{ $requests[0]->department->department_name }}
                                        <br>
                                        <b>Category</b> : {{ $requests[0]->category->category_name }} <br>
                                        <b>Amount</b> : &#8369;
                                        {{ number_format($requests[0]->budget_amount, 2) }} <br>
                                        <b>Period</b> : {{ $requests[0]->periods->period_name }} <br>
                                        <b>Date</b> : {{ $requests[0]->budget_date }} <br>
                                        <b>Justification</b> : {{ $requests[0]->budget_justification }} <br>
                                        <b>Supporting Documents</b> :
                                        {{ $requests[0]->budget_supportingDocumentationName }} <a
                                            href="{{ asset($requests[0]->budget_supportingDocumentation) }}">View</a><br>
                                        @if ($requests[0]->budget_optional === 'Y')
                                            <b>Historical Data</b> :
                                            {{ $requests[0]->budget_historicalData ?? 'No' }} <br>
                                            <b>Risk Factors and Contingencies</b> :
                                            {{ $requests[0]->budget_riskFactorsAndContingencies ?? 'No' }}
                                            <br>
                                            <b>Impact on Operations</b> :
                                            {{ $requests[0]->budget_impactOnOperations ?? 'No' }}
                                            <br>
                                            <b>Alignment with Objectives</b> :
                                            {{ $requests[0]->budget_alignmentWithObjectives ?? 'No' }} <br>
                                            <b>Alternatives Considered</b> :
                                            {{ $requests[0]->budget_alternativesConsidered ?? 'No' }} <br>
                                            <b>Assumptions and Methodology</b> :
                                            {{ $requests[0]->budget_assumptionsAndMethodology ?? 'No' }} <br>
                                        @endif
                                        <b>Status</b>: {{ $requests[0]->status->status_name ?? 'N/A' }}<br>
                                        <b>Approver</b>: {{ optional($requests[0]->approvedBy)->first_name ?? 'N/A' }}
                                        {{ optional($requests[0]->approvedBy)->last_name ?? '' }} <br>
                                        <b>Date</b>: {{ $requests[0]->budget_approvedDate ?? 'N/A' }} <br>
                                        <b>Amount</b>: ₱
                                        {{ number_format($requests[0]->budget_approvedAmount, 2) ?? '0.00' }}
                                        <br>
                                        <b>Notes</b>: {{ $requests[0]->budget_notes ?? 'N/A' }} <br>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        @elseif ($type == 'R2')
                            <div class="card ">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <b>Request Name</b> : {{ $requests[0]->request_name }} <br>
                                        <b>Requestor</b> :
                                        @if ($requests[0]->request_revisedBy != null)
                                            {{ $requests[0]->request_revisedBy }}
                                        @else
                                            {{ $requests[0]->request_createdBy }}
                                        @endif
                                        <br>
                                        @if ($requests[0]->request_email != null)
                                            <b>Requestor Email</b> : {{ $requests[0]->request_email }} <br>
                                        @endif
                                        <b>Department</b> : {{ $requests[0]->department->department_name }} <br>
                                        <b>Category</b> : {{ $requests[0]->category->category_name }} <br>
                                        <b>Amount</b> : &#8369; {{ number_format($requests[0]->request_amount, 2) }} <br>
                                        <b>Period</b> : {{ $requests[0]->periods->period_name }} <br>
                                        <b>Project Details Name</b> : {{ $requests[0]->budget->budget_name ?? 'N/A' }}
                                        <br>
                                        <b>Budget Amount</b> : &#8369;
                                        {{ number_format($requests[0]->budget->budget_amount, 2) ?? 'N/A' }} <br>
                                        <b>Actual Spend</b> : &#8369;
                                        {{ number_format($requests[0]->request_actualSpending, 2) }} <br>
                                        <b>Justification</b> : {{ $requests[0]->request_justification }} <br>
                                        <b>Supporting Documents</b> :
                                        {{ $requests[0]->request_supportingDocumentationName }} <a
                                            href="{{ asset($requests[0]->request_supportingDocumentation) }}">View</a><br>
                                        @if ($requests[0]->request_optional === 'Y')
                                            <b>Historical Data</b> :
                                            {{ $requests[0]->request_historicalData ?? 'No' }} <br>
                                            <b>Risk Factors and Contingencies</b> :
                                            {{ $requests[0]->request_riskFactorsAndContingencies ?? 'No' }}
                                            <br>
                                            <b>Impact on Operations</b> :
                                            {{ $requests[0]->request_impactOnOperations ?? 'No' }}
                                            <br>
                                            <b>Alignment with Objectives</b> :
                                            {{ $requests[0]->request_alignmentWithObjectives ?? 'No' }} <br>
                                            <b>Alternatives Considered</b> :
                                            {{ $requests[0]->request_alternativesConsidered ?? 'No' }} <br>
                                            <b>Assumptions and Methodology</b> :
                                            {{ $requests[0]->request_assumptionsAndMethodology ?? 'No' }} <br>
                                        @endif
                                        <b>Status</b>: {{ $requests[0]->status->status_name ?? 'N/A' }}<br>
                                        <b>Approver</b>: {{ optional($requests[0]->approvedBy)->first_name ?? 'N/A' }}
                                        {{ optional($requests[0]->approvedBy)->last_name ?? '' }} <br>
                                        <b>Date</b>: {{ $requests[0]->request_approvedDate ?? 'N/A' }} <br>
                                        <b>Amount</b>: ₱
                                        {{ number_format($requests[0]->request_approvedAmount, 2) ?? '0.00' }}
                                        <br>
                                        <b>Notes</b>: {{ $requests[0]->request_notes ?? 'N/A' }} <br>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/images/void.svg') }}"
                                            style="min-height:200px; max-height:200px" alt=""><br> <br>
                                        <h4> Want to check your Request Status? </h4>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-4 col-sm-12"></div>
                                        <div class="col-md-4 col-sm-12">
                                            <b>1.</b> Place the code of your request in the search bar. <br>
                                            <b>2.</b> Click Search. <br>
                                            <b>3.</b> Wait for your request to be display. <br>
                                        </div>
                                        <div class="col-md-4 col-sm-12"></div>
                                    </div>
                                    <h4 class="text-center">Thank You.</h4>
                                </div>
                            </div>
                        @endif
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
