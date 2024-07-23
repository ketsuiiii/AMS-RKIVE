@extends('layouts.custom.print')

@section('content')
    <div id="letter-body">
        <div class="text-center fs-5">
            <div class="text-center mb-5">
                <b>
                    Rkive Finance <br>
                    Income Record <br>
                    {{ date('F d, Y') }} <br>
                </b>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Department</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomes as $income)
                    <tr>
                        <td>{{ $income->income_code }}</td>
                        <td>{{ $income->income_name }}</td>
                        <td>₱{{ number_format($income->income_amount, 2) }}</td>
                        <td>{{ $income->income_date }}</td>
                        <td>{{ $income->type->type_name }}</td>
                        <td>{{ $income->department->department_name }}</td>
                        <td>{{ $income->category->plan_category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
