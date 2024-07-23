@extends('layouts.custom.print')

@section('content')
    <div id="lletter-body">
        <div class="text-center mb-5">
            <b>
                Rkive Finance <br>
                Budget Record <br>
                {{ $addbudget->department->department_name }} Department <br>
                {{ date('F d, Y') }} <br>
            </b>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><b>Budget Information</b></td>
                </tr>
                <tr>
                    <td><b>ID</b></td>
                    <td>{{ $budget->id }}</td>
                    <td></td>
                    <td><b>Category</b></td>
                    <td>{{ $budget->category->plan_category_name }}</td>
                </tr>

                <tr>
                    <td><b>Name</b></td>
                    <td>{{ $budget->budget_name }}</td>
                    <td></td>
                    <td><b>Amount</b></td>
                    <td>{{ number_format($budget->budget_amount, 2) }}</td>
                </tr>

                <tr>
                    <td><b>Description</b></td>
                    <td colspan="4">{{ $budget->budget_description }}</td>
                </tr>

                <tr>
                    <td><b>Start Date</b></td>
                    <td>{{ $budget->budget_startDate }}</td>
                    <td></td>
                    <td><b>End Date</b></td>
                    <td>{{ $budget->budget_endDate }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="5" class="text-center"><b>Budget Approval Information</b></td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>{{ $budget->status->status_name }}</td>
                    <td></td>
                    <td><b>Approved Date</b></td>
                    <td>{{ $budget->budget_approvedDate }}</td>
                </tr>

                <tr>
                    <td><b>Approver</b></td>
                    <td>
                        @foreach ($users as $user)
                            @if ($user->username == $budget->budget_approvedBy)
                                {{ $user->first_name . ' ' . $user->last_name }}
                            @endif
                        @endforeach
                    </td>
                    <td></td>
                    <td><b>Approved Amount</b></td>
                    <td>{{ $budget->budget_approvedAmount }}</td>
                </tr>

                <tr>
                    <td><b>Notes</b></td>
                    <td colspan="4">{{ $budget->budget_notes }}</td>
                </tr>
            </tbody>
        </table>
        <div class="page-break">
            <br>
            <table class="table">
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center"><b>Addional Budget
                                Information</b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>ID</b></td>
                        <td>{{ $addbudget->request_code }}</td>
                        <td></td>
                        <td><b>Category</b></td>
                        <td>{{ $addbudget->request_budget_category }}</td>
                    </tr>

                    <tr>
                        <td><b>Budget Code</b></td>
                        <td>{{ $addbudget->request_budget_code }}</td>
                        <td></td>
                        <td><b>Budget Name</b></td>
                        <td>{{ $addbudget->request_budget_name }}</td>
                    </tr>

                    <tr>
                        <td><b>Name</b></td>
                        <td>{{ $addbudget->request_name }}</td>
                        <td></td>
                        <td><b>Amount</b></td>
                        <td>{{ number_format($addbudget->request_amount, 2) }}</td>
                    </tr>

                    <tr>
                        <td><b>Description</b></td>
                        <td colspan="4">{{ $addbudget->request_description }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table class="table">
                <tbody>

                    <tr>
                        <td colspan="5" class="text-center"><b>Request Approval Information</b></td>
                    </tr>
                    <tr>
                        <td><b>Status</b></td>
                        <td>{{ $addbudget->status->status_name }}</td>
                        <td></td>
                        <td><b>Approved Date</b></td>
                        <td>{{ $addbudget->request_approvedDate }}</td>
                    </tr>

                    <tr>
                        <td><b>Approver</b></td>
                        <td>
                            @foreach ($users as $user)
                                @if ($user->username == $addbudget->request_approvedBy)
                                    {{ $user->first_name . ' ' . $user->last_name }}
                                @endif
                            @endforeach
                        </td>
                        <td></td>
                        <td><b>Approved Amount</b></td>
                        <td>{{ number_format($addbudget->request_approvedAmount, 2) }}</td>
                    </tr>

                    <tr>
                        <td><b>Notes</b></td>
                        <td colspan="4">{{ $addbudget->request_notes }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
