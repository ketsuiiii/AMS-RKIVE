@extends('layouts.custom.print')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div id="letter-body">
                    <div class="text-center ">
                        <img id="" src="{{ asset('assets/images/logo/logo1.png') }}" alt=""
                            style="height: 200px; width: auto;">
                        <p>Rkive Financials</br>
                            Date issued:
                            <span>{{ date('F d, Y', strtotime($addbudget->updated_at)) }}</span>
                        </p>
                    </div>
                    <br>
                    <h4 class="text-center"><b>Financial Report</b></h4>
                    <div class="letter">
                        <div class="table">
                            <div class="row p-3">
                                <div class="col-md-12">
                                    Track Code: <span class="fw-bold">{{ $addbudget->id }}</span><br>
                                    Budget Name: <span class="fw-bold">{{ $addbudget->request_name }}</span><br>
                                    Department: <span class="fw-bold">
                                        @foreach ($departments as $item)
                                            @if ($addbudget->department_code == $addbudget->request_department)
                                                {{ $addbudget->department_name }} Department
                                            @endif
                                        @endforeach
                                    </span><br>
                                    Duration: <span class="fw-bold">{{ $addbudget->periods->period_name }}</span><br>
                                    Amount:
                                    <span class="fw-bold">₱{{ number_format($addbudget->request_approvedAmount, 2) }}</span><br>
                                    Remaining Balance:
                                    <span
                                        class="fw-bold">₱{{ number_format($addbudget->request_approvedAmount - $expenseSum, 2) }}</span><br>
                                    Actual Spend:
                                    <span class="fw-bold">₱{{ number_format($expenses->sum('track_amount'), 2) }}</span><br>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr class="border-bottom-primary text-center">
                                        <th scope="col">Expense Category</th>
                                        <th scope="col">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($expenses); --}}
                                    @if ($expenses->isEmpty())
                                        <tr>
                                            <td colspan="2" class="text-center">No expenses
                                                added
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($expenses as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->category->category_name }}</td>
                                            <td>₱{{ number_format($item->track_amount, 2) }}
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
@endsection
