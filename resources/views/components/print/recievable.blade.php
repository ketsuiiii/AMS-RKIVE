@extends('layouts.custom.print')

@section('content')
    <div id="letter-body">
        <div class="text-center fs-5">
            <div class="text-center mb-5">
                <b>
                    Rkive Finance <br>
                    Recievable Record <br>
                    {{ date('F d, Y') }} <br>
                </b>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Invoice Date</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Type</th>
                    <th>Department</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recievables as $recievable)
                    <tr>
                        <td>{{ $recievable->recievable_code }}</td>
                        <td>{{ $recievable->recievable_name }}</td>
                        <td>{{ $recievable->recievable_invoice_date }}</td>
                        <td>₱{{ number_format($recievable->recievable_amount, 2) }}</td>
                        <td>{{ $recievable->recievable_due_date }}</td>
                        <td>{{ $recievable->type->type_name }}</td>
                        <td>{{ $recievable->department->department_name }}</td>
                        <td>{{ $recievable->category->plan_category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
