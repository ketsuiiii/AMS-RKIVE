@extends('layouts.custom.print')

@section('content')
{{-- @dd($travels[0]->TransportationCost) --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Expense</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"> Transportation</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->TransportationCost, 2) }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th scope="row"> Accommodation</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->AccommodationCost, 2) }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th scope="row"> Meal</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->MealsAndIncidentals, 2) }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th scope="row"> Daily Allowance</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->DailyAllowance, 2) }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th scope="row"> Conference Registration Fee</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->ConferenceRegistrationFee, 2) }}
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th scope="row"> Visa Documentation Fee</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->VisaDocumentationFee, 2) }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th scope="row"> Travel Insurance</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->TravelInsuranceCost, 2) }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th scope="row"> Miscellaneous</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->MiscellaneousExpenses, 2) }}</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th scope="row"> Estimated Budget</th>
                <td>
                    <ul>
                        <li>₱{{ number_format((float) $travels[0]->TotalExpenses, 2) }}</li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
