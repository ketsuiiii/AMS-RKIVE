<?php

namespace App\Http\Controllers\Fragments\Cycle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BudgetRequest;
use App\Models\AddBudgetRequest;

class Analytics extends Controller
{
    public function index()
    {

        $budgetRequests = BudgetRequest::all();
        $addBudgetRequests = AddBudgetRequest::all();

        $budgetRequestData = $budgetRequests->map(function ($item) {
            return [
                'request_department' => $item->request_department,
                'department_name' => $item->department->department_name, // Use the accessor method to fetch the department name
                'budget_approvedAmount' => $item->budget_approvedAmount,
            ];
        });

        $addBudgetRequestData = $addBudgetRequests->map(function ($item) {
            return [
                'request_department' => $item->request_department,
                'department_name' => $item->department->department_name, // Use the accessor method to fetch the department name
                'request_approvedAmount' => $item->request_approvedAmount,
                'request_amount' => $item->request_amount,
                'request_actualSpending' => $item->request_actualSpending
            ];
        });

        $data = [
            'budgetPerDepartmentData' => $budgetRequestData,
            'budgetRequestsPerDepartmentData' => $addBudgetRequestData
        ];

        return view('board.new.analytics.index', $data);
    }
}
