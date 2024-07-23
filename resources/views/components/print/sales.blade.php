@extends('layouts.custom.print')

@section('content')
    <div id="letter-body">
        <div class="text-center mb-5">
            <b>
                Rkive Finance <br>
                Sales Record <br>
                {{ date('F d, Y') }} <br>
            </b>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Revenue</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->sales_code }}</td>
                        <td>{{ $sale->sales_product_name }}</td>
                        <td>₱{{ number_format($sale->sales_revenue, 2) }}</td>
                        <td>{{ $sale->sales_date }}</td>
                        <td>{{ $sale->type->type_name }}</td>
                        <td>{{ $sale->category->plan_category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
