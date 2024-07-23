<?php

namespace App\Http\Controllers\Fragments\Cycle;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Fragments\Cycle\API\IntegrationController;

use App\Models\Allocation;
use App\Models\BudgetRequest;
use App\Models\Categories;
use App\Models\Department;
use App\Models\AddBudgetRequest;
use App\Models\Optional;
use App\Models\Period;
use App\Models\Status;
use App\Models\Track;
use App\Models\User;
use App\Models\Notification;

use Illuminate\Http\Request;

class AddBdgtRqst extends Controller
{
    public function roles()
    {
        $roles = auth()->user()->role_code;

        if ($roles === '102') {
            $role = 'admin';
        } elseif ($roles === '103') {
            $role = 'employee';
        }

        return $role;
    }

    public function index()
    {
        if ($this->roles() == 'employee') {
            $filter = AddBudgetRequest::where('request_department', auth()->user()->department_code)->get();
        } else {
            $filter = AddBudgetRequest::all();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'periods' => Period::all(),
            'optionals' => Optional::all(),
            'budgets' => BudgetRequest::all(),
            'requests' => $filter,
        ];

        return view('board.new.addbudgets.index', $data);
    }

    public function create()
    {
        $data1 = [
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'optionals' => Optional::all(),
            'periods' => Period::all(),
            'budgets' => BudgetRequest::all(),
        ];

        if ($this->roles() == 'employee') {
            $filter = auth()->user()->department_code;

            $allocate = Allocation::where('allocation_department', $filter)->sum('allocation_amount');
            $budget = BudgetRequest::where('budget_department', $filter)->sum('budget_approvedAmount');
            $addbudget = AddBudgetRequest::where('request_department', $filter)->sum('request_approvedAmount');
            $track = $budget + $addbudget;
            $remaining = $allocate - $track;
            $data = [
                'department_name' => auth()->user()->department->department_name,
                'department_code' => $filter,
                'allocate' => $allocate,
                'track' => $track,
                'remaining' => $remaining,
            ];
            // dd($data);
        } else {
            $departments = Department::pluck('department_code', 'department_name');
            $data = [];
            foreach ($departments as $department_name => $department_code) {
                $allocate = Allocation::where('allocation_department', $department_code)->sum('allocation_amount');
                $budget = BudgetRequest::where('budget_department', $department_code)->sum('budget_approvedAmount');
                $addbudget = AddBudgetRequest::where('request_department', $department_code)->sum('request_approvedAmount');
                $track = $budget + $addbudget;
                $remaining = $allocate - $track;
                $data[] = [
                    'department_name' => $department_name,
                    'department_code' => $department_code,
                    'allocate' => $allocate,
                    'track' => $track,
                    'remaining' => $remaining,
                ];
            }
        }
        return view('board.new.addbudgets.create', compact('data'), $data1);
    }

    public function store(Request $request)
    {
        $request->validate([
            'request_name' => 'required|unique:g59_addbudget_requests,request_name',
            'request_category' => 'required',
            'request_amount' => 'required',
            'request_justification' => 'required',
            'request_period' => 'required',
            'request_date' => 'required',
            'request_projectDetails' => 'required',
            'request_optional' => 'required',


            // OPTIONAL
            'request_historicalData',
            'request_riskFactorsAndContingencies',
            'request_impactOnOperations',
            'request_alignmentWithObjectives',
            'request_alternativesConsidered',
            'request_assumptionsAndMethodology',

            // DOCUMENTATION
            'request_supportingDocumentation' => 'required|max:10000|mimes:doc,docx,pdf,png,jpg,jpeg',

        ]);

        // Convert the amount from the format "₱123,456.78" to "123456.78"
        $request_amount = str_replace("₱", "", $request->request_amount);
        $convert_amount1 = str_replace(",", "", $request_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        // Find the budget's approved amount from the database
        $request_budget_code = BudgetRequest::where('id', $request->request_projectDetails)->get();
        $request_budgetApproved = str_replace(',', '', $request_budget_code[0]->budget_approvedAmount);
        $request_budgetDepartment = $request_budget_code[0]->budget_department;
        // dd($request_budgetDepartment);

        // Add the approved amount with the actual spending and convert it to a number
        $request_actualSpending = $request_budgetApproved + (float) $convert_amount;

        $allocate = Allocation::where('allocation_department', $request_budgetDepartment)->sum('allocation_amount');
        $budget = BudgetRequest::where('budget_department', $request_budgetDepartment)->sum('budget_approvedAmount');
        $addbudget = AddBudgetRequest::where('request_department', $request_budgetDepartment)->sum('request_approvedAmount');
        $track = $budget + $addbudget;
        $remaining = $allocate - $track;

        if ($remaining < $convert_amount) {
            $remaining_formatted = number_format($remaining, 2);
            $convert_amount_formatted = number_format($convert_amount, 2);
            $department = Department::where('department_code', $request_budgetDepartment)->first()->department_name;
            $error_message = "Insufficient budget amount. Remaining budget for {$department} is PHP {$remaining_formatted}, requested amount is PHP {$convert_amount_formatted}.";

            return redirect()->back()->withInput()->with('error', $error_message)->with('error_message', $error_message);
        } elseif ($remaining == 0) {
            $department = Department::where('department_code', $request_budgetDepartment)->first()->department_name;
            $error_message = "You have no remaining budget for {$department}.";

            return redirect()->back()->withInput()->with('error', $error_message)->with('error_message', $error_message);
        }

        if ($request->has('request_supportingDocumentation')) {

            $file = $request->file('request_supportingDocumentation');
            $extension = $file->getClientOriginalExtension();

            $fileName = uniqid() . '.' . $extension;

            $path = 'uploads/category/addbudgets/';
            $filePath = $file->move($path, $fileName);
        }

        AddBudgetRequest::create([
            'request_code' => 'RC' . uniqid(),
            'request_createdBy' => auth()->user()->username,
            'request_name' => $request->request_name,
            'request_department' => $request_budgetDepartment,
            'request_amount' => $convert_amount,
            'request_category' => $request->request_category,
            'request_period' => $request->request_period,
            'request_date' => date('Y-m-d', strtotime($request->request_date)),
            'request_optional' => $request->request_optional,
            'request_projectDetails' => $request->request_projectDetails,

            'request_actualSpending' => $request_actualSpending,
            'request_justification' => $request->request_justification,

            'request_status' => 'S2',
            'request_type' => 'R2',

            // DOCUMENTATION
            'request_supportingDocumentationName' => $fileName,
            'request_supportingDocumentation' => $filePath,

            // OPTIONAL
            'request_historicalData' => $request->request_historicalData,
            'request_riskFactorsAndContingencies' => $request->request_riskFactorsAndContingencies,
            'request_impactOnOperations' => $request->request_impactOnOperations,
            'request_alignmentWithObjectives' => $request->request_alignmentWithObjectives,
            'request_alternativesConsidered' => $request->request_alternativesConsidered,
            'request_assumptionsAndMethodology' => $request->request_assumptionsAndMethodology,
        ]);

        return redirect()->route('' . $this->roles() . '.new.addbudget')->with('success', 'AddBudget Request created successfully');
    }

    public function edit(string $id)
    {
        $request = AddBudgetRequest::findOrFail($id);

        $departmentaddBudget = AddBudgetRequest::where('request_department', $request->request_department)->sum('request_approvedAmount');
        $departmentBudget = BudgetRequest::where('budget_department', $request->request_department)->sum('budget_approvedAmount');
        $departmentSpend = Track::where('track_department', $request->request_department)->sum('track_amount');
        $allocate = Allocation::where('allocation_department', $request->request_department)->sum('allocation_amount');
        $balance = $departmentBudget + $departmentaddBudget;
        $departmentBalance = $allocate - $balance;

        $data = [
            'requests' => $request,
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'periods' => Period::all(),
            'optionals' => Optional::all(),
            'budgets' => BudgetRequest::all(),
            'departmentBudget' => $departmentBudget,
            'departmentSpend' => $departmentSpend,
            'departmentBalance' => $departmentBalance
        ];

        if ($this->roles() == 'admin') {
            return view('board.new.addbudgets.admin-edit', $data);
        } elseif ($this->roles() == 'employee') {
            return view('board.new.addbudgets.employee-edit', $data);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'request_status' => 'required',
            'request_approvedBy' => 'required',
            'request_approvedAmount' => 'required',
            'request_approvedDate' => 'required',
            'request_notes' => 'required',
        ]);

        $request_approvedAmount = str_replace("₱", "", $request->request_approvedAmount);

        $convert_amount1 = str_replace(",", "", $request_approvedAmount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        $requests = AddBudgetRequest::find($id);

        $allocate = Allocation::where('allocation_department', $requests->request_department)->sum('allocation_amount');
        $budget = BudgetRequest::where('budget_department', $requests->request_department)->sum('budget_approvedAmount');
        $addbudget = AddBudgetRequest::where('request_department', $requests->request_department)->sum('request_approvedAmount');
        $track = $budget + $addbudget;
        $remaining = $allocate - $track;

        if ($remaining < $convert_amount) {
            $remaining_formatted = number_format($remaining, 2);
            $convert_amount_formatted = number_format($convert_amount, 2);
            $department = Department::where('department_code', $requests->request_department)->first()->department_name;
            $error_message = "Insufficient budget amount. Remaining budget for {$department} is PHP {$remaining_formatted}, requested amount is PHP {$convert_amount_formatted}.";

            return redirect()->back()->withInput()->with('error', $error_message)->with('error_message', $error_message);
        } elseif ($remaining == 0) {
            $department = Department::where('department_code', $requests->request_department)->first()->department_name;
            $error_message = "You have no remaining budget for {$department}.";

            return redirect()->back()->withInput()->with('error', $error_message)->with('error_message', $error_message);
        }

        if ($request->request_status == "S1") {
            if ($requests) {

                $requests->update([
                    'request_status' => $request->request_status,
                    'request_approvedBy' => $request->request_approvedBy,
                    'request_approvedAmount' => $convert_amount,
                    'request_approvedDate' => date('Y-m-d', strtotime($request->request_approvedDate)),
                    'request_notes' => $request->request_notes,
                ]);

                Notification::create([
                    'status' => 'success',
                    'title' => 'Your Additional Budget Request has been Approved',
                    'content' => $requests->request_name . ' has been approved',
                    'from' => $requests->request_approvedBy,
                    'to' => $requests->request_department,
                    'reference' => $requests->request_code,
                    'type' => $requests->request_type
                ]);

                $data = [
                    'code' => $requests->request_code,
                    'mailTo' => $requests->request_email,
                    'mailType' => 'R2',
                    'mailStatus' => 'S1',
                ];

                if (isset($requests->request_email)) {
                    (new IntegrationController())->mailResponse($data);
                }

                return redirect()->route('' . $this->roles() . '.new.addbudget')->with('success', 'AddBudget Request Approved successfully');
            }
        } else if ($request->request_status == 'S3') {
            if ($requests) {

                $requests->update([
                    'request_status' => $request->request_status,
                    'request_approvedBy' => $request->request_approvedBy,
                    'request_approvedAmount' => $convert_amount,
                    'request_approvedDate' => date('Y-m-d', strtotime($request->request_approvedDate)),
                    'request_notes' => $request->request_notes,
                ]);

                Notification::create([
                    'status' => 'danger',
                    'title' => 'Your Additional Budget Request has been Rejected',
                    'content' => $requests->request_name . ' has been rejected',
                    'from' => $requests->request_approvedBy,
                    'to' => $requests->request_department,
                    'reference' => $requests->request_code,
                    'type' => $requests->request_type
                ]);

                $data = [
                    'code' => $requests->request_code,
                    'mailTo' => $requests->request_email,
                    'mailType' => 'R2',
                    'mailStatus' => 'S3',
                ];

                if (isset($requests->request_email)) {
                    (new IntegrationController())->mailResponse($data);
                }
                return redirect()->route('' . $this->roles() . '.new.addbudget')->with('success', 'AddBudget Request Rejected successfully');
            }
        }
        return redirect()->back()->with('error', 'Budget request not found');
    }

    public function revise(Request $request, string $id)
    {
        $request->validate([
            'request_name' => 'required',
            'request_category' => 'required',
            'request_amount' => 'required',
            'request_justification' => 'required',
            'request_period' => 'required',
            'request_date' => 'required',
            'request_projectDetails' => 'required',
            'request_optional' => 'required',


            // OPTIONAL
            'request_historicalData',
            'request_riskFactorsAndContingencies',
            'request_impactOnOperations',
            'request_alignmentWithObjectives',
            'request_alternativesConsidered',
            'request_assumptionsAndMethodology',

            // DOCUMENTATION
            'request_supportingDocumentation' => 'required|max:10000|mimes:doc,docx,pdf,png,jpg,jpeg',

        ]);

        // Convert the amount from the format "₱123,456.78" to "123456.78"
        $request_amount = str_replace("₱", "", $request->request_amount);
        $convert_amount1 = str_replace(",", "", $request_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_request = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        // Find the budget's approved amount from the database
        $request_budget_code = BudgetRequest::where('id', $request->request_projectDetails)->get();
        $request_budgetApproved = str_replace(',', '', $request_budget_code[0]->budget_approvedAmount);
        $request_budgetDepartment = $request_budget_code[0]->budget_department;


        // Add the approved amount with the actual spending and convert it to a number
        $request_actualSpending = $request_budgetApproved + $convert_request;

        if ($request->has('request_supportingDocumentation')) {

            $file = $request->file('request_supportingDocumentation');
            $extension = $file->getClientOriginalExtension();

            $fileName = uniqid() . '.' . $extension;

            $path = 'uploads/category/new/addbudgets/';
            $filePath = $file->move($path, $fileName);
        }

        $requests = AddBudgetRequest::find($id);

        if ($requests) {

            $requests->update([
                'request_revisedBy' => auth()->user()->username,
                'request_name' => $request->request_name,
                'request_department' => $request_budgetDepartment,
                'request_amount' => $convert_request,
                'request_category' => $request->request_category,
                'request_period' => $request->request_period,
                'request_date' => date('Y-m-d', strtotime($request->request_date)),
                'request_optional' => $request->request_optional,
                'request_projectDetails' => $request->request_projectDetails,

                'request_actualSpending' => $request_actualSpending,
                'request_justification' => $request->request_justification,

                'request_status' => 'S2',
                'request_type' => 'R2',

                // DOCUMENTATION
                'request_supportingDocumentationName' => $fileName,
                'request_supportingDocumentation' => $filePath,

                // OPTIONAL
                'request_historicalData' => $request->request_historicalData,
                'request_riskFactorsAndContingencies' => $request->request_riskFactorsAndContingencies,
                'request_impactOnOperations' => $request->request_impactOnOperations,
                'request_alignmentWithObjectives' => $request->request_alignmentWithObjectives,
                'request_alternativesConsidered' => $request->request_alternativesConsidered,
                'request_assumptionsAndMethodology' => $request->request_assumptionsAndMethodology,

            ]);

            return redirect()->route('' . $this->roles() . '.new.addbudget')->with('success', 'AddBudget Request Revised successfully');
        }

        return redirect()->back()->with('error', 'Budget request not found');
    }

    public function destroy(string $id, Request $request)
    {
        $request->validate([

        ]);

        $requests = AddBudgetRequest::find($id);

        if ($requests) {
            $requests->delete();
            return redirect()->route('' . $this->roles() . '.new.addbudget')->with('success', 'Budget deleted successfully');
        }

        return redirect()->back()->with('error', 'Budget request not found');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        if (strtolower($search) == 'pending') {
            $search = 'S2';
        } elseif (strtolower($search) == 'approved') {
            $search = 'S1';
        } elseif (strtolower($search) == 'rejected') {
            $search = 'S3';
        }

        if ($this->roles() == 'employee') {
            $filter = AddBudgetRequest::where('request_department', auth()->user()->department_code)
                ->where(function ($query) use ($search) {
                    $query->where('request_name', 'like', '%' . $search . '%')
                        ->orWhere('request_amount', 'like', '%' . $search . '%')
                        ->orWhere('request_code', 'like', '%' . $search . '%')
                        ->orWhere('request_category', 'like', '%' . $search . '%')
                        ->orWhere('request_projectDetails', 'like', '%' . $search . '%')
                        ->orWhere('request_justification', 'like', '%' . $search . '%')
                        ->orWhere('request_status', 'like', '%' . $search . '%')
                        ->orWhere('request_approvedBy', 'like', '%' . $search . '%')
                        ->orWhere('request_approvedDate', 'like', '%' . $search . '%')
                        ->orWhere('request_approvedAmount', 'like', '%' . $search . '%')
                        ->orWhere('request_notes', 'like', '%' . $search . '%');
                });
        } else {
            $filter = AddBudgetRequest::where('request_name', 'like', '%' . $search . '%')
                ->orWhere('request_amount', 'like', '%' . $search . '%')
                ->orWhere('request_code', 'like', '%' . $search . '%')
                ->orWhere('request_category', 'like', '%' . $search . '%')
                ->orWhere('request_projectDetails', 'like', '%' . $search . '%')
                ->orWhere('request_justification', 'like', '%' . $search . '%')
                ->orWhere('request_status', 'like', '%' . $search . '%')
                ->orWhere('request_approvedBy', 'like', '%' . $search . '%')
                ->orWhere('request_approvedDate', 'like', '%' . $search . '%')
                ->orWhere('request_approvedAmount', 'like', '%' . $search . '%')
                ->orWhere('request_notes', 'like', '%' . $search . '%');
        }

        $data = [
            'users' => User::all(),
            'status' => Status::all(),
            'categories' => Categories::all(),
            'budgets' => BudgetRequest::all(),
            'departments' => Department::all(),
            'periods' => Period::all(),
            'optionals' => Optional::all(),
            'requests' => $filter->get(),
        ];

        return view('board.new.addbudgets.index', $data);
    }


}
