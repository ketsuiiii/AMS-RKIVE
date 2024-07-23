@extends('layouts.custom.print')

@section('content')
    <div id="letter-body">
        <div class="text-center fs-5">
            <div class="text-center mb-5">
                <b>
                    Rkive Finance <br>
                    Balance Record <br>
                    {{ date('F d, Y') }} <br>
                </b>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($balances as $balance)
                    <tr>
                        <td>{{ $balance->balance_name }}</td>
                        <td>₱{{ number_format($balance->balance_amount, 2) }}</td>
                        <td>{{ $balance->category->plan_category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
