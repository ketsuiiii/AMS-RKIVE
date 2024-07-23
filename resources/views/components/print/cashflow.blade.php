@extends('layouts.custom.print')

@section('content')
    <div id="letter-body">
        <div class="text-center fs-5">
            <div class="text-center mb-5">
                <b>
                    Rkive Finance <br>
                    Cash Flow Record <br>
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
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cashflows as $cashflow)
                    <tr>
                        <td>{{ $cashflow->cashflow_code }}</td>
                        <td>{{ $cashflow->cashflow_name }}</td>
                        <td>₱{{ number_format($cashflow->cashflow_amount, 2) }}</td>
                        <td>{{ $cashflow->cashflow_date }}</td>
                        <td>{{ $cashflow->category->plan_category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
