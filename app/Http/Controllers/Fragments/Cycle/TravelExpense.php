<?php

namespace App\Http\Controllers\Fragments\Cycle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travels;
use App\Models\TravelsExpenses;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class TravelExpense extends Controller
{
    // public function index()
    // {
    //     $data = [
    //         'travels' => TravelsExpenses::with('reports')->get()
    //     ];
    //     return view('board.new.travel_expense.index', $data);
    // }

    public function view($RequestID)
    {
        $expenses = TravelsExpenses::with('reports', 'user')->where('RequestID', $RequestID)->get();

        $reports = TravelsExpenses::with('reports')->where('RequestID', $RequestID);
        // Grouped Totals
        $groupedExpenses = $reports
            ->select(
                'ReportID',
                DB::raw('SUM(TransportationCost) AS totalTransportationCost'),
                DB::raw('SUM(AccommodationCost) AS totalAccommodationCost'),
                DB::raw('SUM(DailyAllowance) AS totalDailyAllowance'),
                DB::raw('SUM(MealsAndIncidentals) AS totalMeals'),
                DB::raw('SUM(ConferenceRegistrationFee) AS totalConferenceRegistrationFee'),
                DB::raw('SUM(VisaDocumentationFee) AS totalVisaDocumentationFee'),
                DB::raw('SUM(TravelInsuranceCost) AS totalTravelInsuranceCost'),
                DB::raw('SUM(MiscellaneousExpenses) AS totalMiscellaneousExpenses'),
                DB::raw('SUM(TotalExpenses) AS totalEstimatedBudget'),
                DB::raw('MAX(TravelerName) AS TravelerName'), // Use MAX() to select one TravelerName per group
                DB::raw('MAX(RequestID) AS RequestID') // Use MAX() to select one RequestID per group
            )->groupBy('ReportID')->get()->keyBy('ReportID');

        $data = [
            'expenses' => $expenses,
            'id' => $RequestID,
            'name' => $expenses->first()->TravelerName,
            'totalTransportationCost' => $expenses->sum('TransportationCost'),
            'totalAccommodationCost' => $expenses->sum('AccommodationCost'),
            'totalDailyAllowance' => $expenses->sum('DailyAllowance'),
            'totalMeals' => $expenses->sum('MealsAndIncidentals'),
            'totalConferenceRegistrationFee' => $expenses->sum('ConferenceRegistrationFee'),
            'totalVisaDocumentationFee' => $expenses->sum('VisaDocumentationFee'),
            'totalTravelInsuranceCost' => $expenses->sum('TravelInsuranceCost'),
            'totalMiscellaneousExpenses' => $expenses->sum('MiscellaneousExpenses'),
            'totalEstimatedBudget' => $expenses->sum('TotalExpenses'),
            'groupedExpenses' => $groupedExpenses
        ];

        return view('board.new.travel_expense.view', $data);
    }

    public function index()
    {
        try {
            $expenses = TravelsExpenses::with('reports')->get();
        } catch (QueryException $e) {
            // Check if the exception is because of a missing table
            if ($e->getCode() == '42S02') {
                if (auth()->user()->role_code === '103') {
                    return view('board.new.error');
                    } else {
                    // '42S02' is the SQL state code for "base table or view not found"
                    return view('board.new.not_found');
                }
            }
            // If it's a different exception, rethrow it or handle it accordingly
            throw $e;
        }

        $totalTransportationCost = $expenses->sum('TransportationCost');
        $totalAccommodationCost = $expenses->sum('AccommodationCost');
        $totalDailyAllowance = $expenses->sum('DailyAllowance');
        $totalMeals = $expenses->sum('MealsAndIncidentals');
        $totalConferenceRegistrationFee = $expenses->sum('ConferenceRegistrationFee');
        $totalVisaDocumentationFee = $expenses->sum('VisaDocumentationFee');
        $totalTravelInsuranceCost = $expenses->sum('TravelInsuranceCost');
        $totalMiscellaneousExpenses = $expenses->sum('MiscellaneousExpenses');
        $totalEstimatedBudget = $expenses->sum('TotalExpenses');
        // Grouped Totals
        $groupedExpenses = TravelsExpenses::with('reports')
            ->select(
                'RequestID',
                DB::raw('SUM(TransportationCost) AS totalTransportationCost'),
                DB::raw('SUM(AccommodationCost) AS totalAccommodationCost'),
                DB::raw('SUM(DailyAllowance) AS totalDailyAllowance'),
                // Add similar DB::raw for other expense columns
                DB::raw('SUM(MealsAndIncidentals) AS totalMeals'),
                DB::raw('SUM(ConferenceRegistrationFee) AS totalConferenceRegistrationFee'),
                DB::raw('SUM(VisaDocumentationFee) AS totalVisaDocumentationFee'),
                DB::raw('SUM(TravelInsuranceCost) AS totalTravelInsuranceCost'),
                DB::raw('SUM(MiscellaneousExpenses) AS totalMiscellaneousExpenses'),
                DB::raw('SUM(TotalExpenses) AS totalEstimatedBudget')
            )
            ->groupBy('RequestID')
            ->get();
        return view(
            'board.new.travel_expense.index',
            compact(
                'expenses',
                'totalTransportationCost',
                'totalAccommodationCost',
                'totalDailyAllowance',
                'totalMeals',
                'totalConferenceRegistrationFee',
                'totalVisaDocumentationFee',
                'totalTravelInsuranceCost',
                'totalMiscellaneousExpenses',
                'totalEstimatedBudget',
                'groupedExpenses'
            )
        );
    }

}
