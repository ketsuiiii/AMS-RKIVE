@extends('layouts.custom.print')

@section('content')
    <div id="letter-body">
        <div class="text-center fs-5">
            <div class="text-center mb-5">
                <b>
                    Rkive Finance <br>
                    Turnover Record <br>
                    {{ date('F d, Y') }} <br>
                </b>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Cost of Goods Sold</th>
                    <th>Inventory Turnover Ratio</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Department</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turnovers as $turnover)
                    <tr>
                        <td>{{ $turnover->turnover_code }}</td>
                        <td>{{ $turnover->turnover_product_name }}</td>
                        <td>₱{{ number_format($turnover->turnover_cost_of_goods_sold, 2) }}</td>
                        <td>{{ $turnover->turnover_inventory_turnover_ratio }}</td>
                        <td>{{ $turnover->turnover_date }}</td>
                        <td>{{ $turnover->type->type_name }}</td>
                        <td>{{ $turnover->department->department_name }}</td>
                        <td>{{ $turnover->category->plan_category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
