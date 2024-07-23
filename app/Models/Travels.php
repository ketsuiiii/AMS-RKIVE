<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Travels extends Model
{
    use HasFactory;

    protected $table = 'g59_travel_budget_requests';

    protected $fillable = [
        'RequestID',
        'UserID',
        'Travel',
        'Department',
        'StartDate',
        'EndDate',
        'Destinations',
        'PurposeOfTravel',
        'NumberOfTravelers',
        'ModeOfTransportation',
        'TransportationCost',
        'TypeOfAccomodation',
        'AccomodationCost',
        'DailyAllowance',
        'ConferenceRegistration',
        'VisaDocumentationFee',
        'TravelInsuranceCost',
        'MiscellaneousExpenses',
        'Remarks',
        'TotalEstimatedBudget',
        'Justification',
        'ExpectedOutcomes',
        'TravelPolicyCompliance',
        'AlternativeOptionsConsidered',
        'Itenerary',
        'QuotesEstimates',
        'DateSubmitted',
        'Status',
        'DateApproved',
        'ApprovedBy',
        'Notes'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'Status', 'status_code');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
    public function travelExpense()
    {
        return $this->hasMany(TravelsExpenses::class);
    }


}
