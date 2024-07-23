@extends('layouts.custom.print')

@section('content')
    <div id="letter-body">
        <div class="text-center fs-5">
            <div class="text-center mb-5">
                <b>
                    Rkive Finance <br>
                    Payable Record <br>
                    {{ date('F d, Y') }} <br>
                </b>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Department</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payables as $payable)
                    <tr>
                        <td>{{ $payable->payable_code }}</td>
                        <td>{{ $payable->payable_name }}</td>
                        <td>₱{{ number_format($payable->payable_amount, 2) }}</td>
                        <td>{{ $payable->payable_date }}</td>
                        <td>{{ $payable->type->type_name }}</td>
                        <td>{{ $payable->department->department_name }}</td>
                        <td>{{ $payable->category->plan_category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
