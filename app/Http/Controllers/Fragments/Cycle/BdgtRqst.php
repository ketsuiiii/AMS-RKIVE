<?php

namespace App\Http\Controllers\Fragments\Cycle;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Fragments\Cycle\API\IntegrationController;
use App\Models\AddBudgetRequest;
use App\Models\Allocation;
use App\Models\Categories;
use App\Models\Department;
use App\Models\BudgetRequest;
use App\Models\Notification;
use App\Models\Optional;
use App\Models\Period;
use App\Models\Status;
use App\Models\Track;
use App\Models\User;

use Illuminate\Http\Request;

class BdgtRqst extends Controller
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
            $filter = BudgetRequest::where('budget_department', auth()->user()->department_code)->get();
        } else {
            $filter = BudgetRequest::all();
        }
        $data = [
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'optionals' => Optional::all(),
            'periods' => Period::all(),
            'budgets' => $filter,
        ];
        return view('board.new.budgets.index', $data);
    }

    public function create()
    {
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

        $data1 = [
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'optionals' => Optional::all(),
            'periods' => Period::all(),
        ];

        return view('board.new.budgets.create', compact('data'), $data1);
    }


    public function store(Request $request)
    {
        $request->validate([
            'budget_name' => 'required|unique:g59_budget_requests,budget_name',
            'budget_amount' => 'required',
            'budget_justification' => 'required',
            'budget_period' => 'required',
            'budget_date' => 'required',
            'budget_optional' => 'required',
            'budget_category' => 'required',

            // DOCUMENTATION
            'budget_supportingDocumentation' => 'required|max:10000|mimes:doc,docx,pdf,png,jpg,jpeg',

            // OPTIONAL
            'budget_historicalData',
            'budget_riskFactorsAndContingencies',
            'budget_impactOnOperations',
            'budget_alignmentWithObjectives',
            'budget_alternativesConsidered',
            'budget_assumptionsAndMethodology',
        ]);

        if ($this->roles() == 'Admin') {
            $request->validate([
                'budget_department' => 'required',
            ]);
        }

        if ($this->roles() == 'employee') {
            $department = auth()->user()->department_code;
        } else {
            $department = $request->budget_department;
        }

        $budget_amount = str_replace("₱", "", $request->budget_amount);

        $convert_amount1 = str_replace(",", "", $budget_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        $allocate = Allocation::where('allocation_department', $department)->sum('allocation_amount');
        $budget = BudgetRequest::where('budget_department', $department)->sum('budget_approvedAmount');
        $addbudget = AddBudgetRequest::where('request_department', $department)->sum('request_approvedAmount');
        $track = $budget + $addbudget;
        $remaining = $allocate - $track;

        if ($remaining < $convert_amount) {
            $remaining_formatted = number_format($remaining, 2);
            $convert_amount_formatted = number_format($convert_amount, 2);
            $department = Department::where('department_code', $department)->first()->department_name;
            $error_message = "Insufficient budget amount. Remaining budget for {$department} is PHP {$remaining_formatted}, requested amount is PHP {$convert_amount_formatted}.";

            return redirect()->back()->withInput()->with('error', $error_message)->with('error_message', $error_message);
        } elseif ($remaining == 0) {
            $department = Department::where('department_code', $department)->first()->department_name;
            $error_message = "You have no remaining budget for {$department}.";

            return redirect()->back()->withInput()->with('error', $error_message)->with('error_message', $error_message);
        }


        if ($request->has('budget_supportingDocumentation')) {

            $file = $request->file('budget_supportingDocumentation');
            $extension = $file->getClientOriginalExtension();

            $fileName = uniqid() . '.' . $extension;

            $path = 'uploads/category/budgets/';
            $filePath = $file->move($path, $fileName);
        }

        BudgetRequest::create([
            'budget_code' => 'BC' . uniqid(),
            'budget_createdBy' => auth()->user()->username,
            'budget_name' => $request->budget_name,
            'budget_amount' => $convert_amount,
            'budget_justification' => $request->budget_justification,
            'budget_period' => $request->budget_period,
            'budget_date' => date('Y-m-d', strtotime($request->budget_date)),
            'budget_optional' => $request->budget_optional,
            'budget_category' => $request->budget_category,
            'budget_department' => $department,


            // DOCUMENTATION
            'budget_supportingDocumentationName' => $fileName,
            'budget_supportingDocumentation' => $filePath,

            // OPTIONAL
            'budget_historicalData' => $request->budget_historicalData,
            'budget_riskFactorsAndContingencies' => $request->budget_riskFactorsAndContingencies,
            'budget_impactOnOperations' => $request->budget_impactOnOperations,
            'budget_alignmentWithObjectives' => $request->budget_alignmentWithObjectives,
            'budget_alternativesConsidered' => $request->budget_alternativesConsidered,
            'budget_assumptionsAndMethodology' => $request->budget_assumptionsAndMethodology,

            'budget_status' => 'S2',
            'budget_type' => 'R1',
        ]);


        return redirect()->route('' . $this->roles() . '.new.budget')->with('success', 'Budget created successfully');

    }

    public function edit(string $id)
    {
        $request = BudgetRequest::findOrFail($id);

        $departmentaddBudget = AddBudgetRequest::where('request_department', $request->budget_department)->sum('request_approvedAmount');
        $departmentBudget = BudgetRequest::where('budget_department', $request->budget_department)->sum('budget_approvedAmount');
        $departmentSpend = Track::where('track_department', $request->budget_department)->sum('track_amount');
        $allocate = Allocation::where('allocation_department', $request->budget_department)->sum('allocation_amount');
        $balance = $departmentBudget + $departmentaddBudget;
        $departmentBalance = $allocate - $balance;

        $data = [
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'optionals' => Optional::all(),
            'periods' => Period::all(),
            'request' => $request,
            'departmentBudget' => $allocate,
            'departmentSpend' => $departmentSpend,
            'departmentBalance' => $departmentBalance
        ];

        if ($this->roles() == 'admin') {
            return view('board.new.budgets.admin-edit', $data);
        } elseif ($this->roles() == 'employee') {
            return view('board.new.budgets.employee-edit', $data);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'budget_approvedAmount' => 'required',
            'budget_notes' => 'required',

        ]);
        $requests = BudgetRequest::find($id);

        $budget_approvedAmount = str_replace("₱", "", $request->input('budget_approvedAmount'));

        $convert_amount1 = str_replace(",", "", $budget_approvedAmount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        $allocate = Allocation::where('allocation_department', $requests->budget_department)->sum('allocation_amount');
        $budget = BudgetRequest::where('budget_department', $requests->budget_department)->sum('budget_approvedAmount');
        $addbudget = AddBudgetRequest::where('request_department', $requests->budget_department)->sum('request_approvedAmount');
        $track = $budget + $addbudget;
        $remaining = $allocate - $track;

        if ($remaining < $convert_amount) {
            $remaining_formatted = number_format($remaining, 2);
            $convert_amount_formatted = number_format($convert_amount, 2);
            $department = Department::where('department_code', $requests->budget_department)->first()->department_name;
            $error_message = "Insufficient budget amount. Remaining budget for {$department} is PHP {$remaining_formatted}, requested amount is PHP {$convert_amount_formatted}.";

            return redirect()->back()->withInput()->with('error', $error_message)->with('error_message', $error_message);
        } elseif ($remaining == 0) {
            $department = Department::where('department_code', $requests->budget_department)->first()->department_name;
            $error_message = "You have no remaining budget for {$department}.";

            return redirect()->back()->withInput()->with('error', $error_message)->with('error_message', $error_message);
        }
        if ($request->budget_status == 'S1') {
            if ($requests) {

                $requests->update([
                    'budget_status' => $request->budget_status,
                    'budget_approvedBy' => $request->budget_approvedBy,
                    'budget_approvedAmount' => $convert_amount,
                    'budget_approvedDate' => date('Y-m-d', strtotime($request->budget_approvedDate)),
                    'budget_notes' => $request->budget_notes,
                ]);

                Notification::create([
                    'status' => 'success',
                    'title' => 'Your Budget Request has been Approved',
                    'content' => $requests->budget_name . ' has been approved',
                    'from' => $requests->budget_approvedBy,
                    'to' => $requests->budget_department,
                    'reference' => $requests->budget_code,
                    'type' => $requests->budget_type
                ]);

                $data = [
                    'code' => $requests->budget_code,
                    'mailTo' => $requests->budget_email,
                    'mailType' => 'R1',
                    'mailStatus' => 'S1',
                ];

                if (isset($requests->budget_email)) {
                    (new IntegrationController())->mailResponse($data);
                }

                return redirect()->route('' . $this->roles() . '.new.budget')->with('success', 'Budget Approved successfully');
            }
        } elseif ($request->budget_status == 'S3') {
            if ($requests) {
                $requests->update([
                    'budget_status' => $request->budget_status,
                    'budget_approvedBy' => $request->budget_approvedBy,
                    'budget_approvedAmount' => $convert_amount,
                    'budget_approvedDate' => date('Y-m-d', strtotime($request->budget_approvedDate)),
                    'budget_notes' => $request->budget_notes,
                ]);

                Notification::create([
                    'status' => 'danger',
                    'title' => 'Sorry, Your Budget Request has been Rejected',
                    'content' => $requests->budget_name . ' has been rejected',
                    'from' => $requests->budget_approvedBy,
                    'to' => $requests->budget_department,
                    'reference' => $requests->budget_code,
                    'type' => $requests->budget_type
                ]);


                $data = [
                    'code' => $requests->budget_code,
                    'mailTo' => $requests->budget_email,
                    'mailType' => 'R1',
                    'mailStatus' => 'S3',
                ];

                if (isset($requests->budget_email)) {
                    (new IntegrationController())->mailResponse($data);
                }

                return redirect()->route('' . $this->roles() . '.new.budget')->with('success', 'Budget Rejected successfully');
            }
        }

        return redirect()->back()->with('error', 'Budget not found');
    }

    public function revise(Request $request, string $id)
    {
        $request->validate([
            'budget_name' => 'required',
            'budget_amount' => 'required',
            'budget_justification' => 'required',
            'budget_period' => 'required',
            'budget_date' => 'required',
            'budget_optional' => 'required',
            'budget_category' => 'required',

            // DOCUMENTATION
            'budget_supportingDocumentation' => 'required|max:10000|mimes:doc,docx,pdf,png,jpg,jpeg',

            // OPTIONAL
            'budget_historicalData',
            'budget_riskFactorsAndContingencies',
            'budget_impactOnOperations',
            'budget_alignmentWithObjectives',
            'budget_alternativesConsidered',
            'budget_assumptionsAndMethodology',


        ]);

        $budget_amount = str_replace("₱", "", $request->budget_amount);

        $convert_amount1 = str_replace(",", "", $budget_amount); // Remove commas
        $dotPosition = strpos($convert_amount1, '.'); // Find the position of the '.'
        $convert_amount = substr($convert_amount1, 0, $dotPosition); // Remove everything after the '.'

        if ($request->has('budget_supportingDocumentation')) {

            $file = $request->file('budget_supportingDocumentation');
            $extension = $file->getClientOriginalExtension();

            $fileName = uniqid() . '.' . $extension;

            $path = 'uploads/category/budgets/';
            $filePath = $file->move($path, $fileName);
        }

        $requests = BudgetRequest::find($id);

        if ($requests) {
            $requests->update([
                'budget_revisedBy' => auth()->user()->username,
                'budget_name' => $request->budget_name,
                'budget_amount' => $convert_amount,
                'budget_justification' => $request->budget_justification,
                'budget_period' => $request->budget_period,
                'budget_date' => date('Y-m-d', strtotime($request->budget_date)),
                'budget_optional' => $request->budget_optional,
                'budget_category' => $request->budget_category,
                'budget_department' => $request->budget_department,
                'budget_status' => 'S2',
                // DOCUMENTATION
                'budget_supportingDocumentationName' => $fileName,
                'budget_supportingDocumentation' => $filePath,

                // OPTIONAL
                'budget_historicalData' => $request->budget_historicalData,
                'budget_riskFactorsAndContingencies' => $request->budget_riskFactorsAndContingencies,
                'budget_impactOnOperations' => $request->budget_impactOnOperations,
                'budget_alignmentWithObjectives' => $request->budget_alignmentWithObjectives,
                'budget_alternativesConsidered' => $request->budget_alternativesConsidered,
                'budget_assumptionsAndMethodology' => $request->budget_assumptionsAndMethodology,
            ]);

            return redirect()->route('' . $this->roles() . '.new.budget')->with('success', 'Budget Revised successfully');

        }

        return redirect()->back()->with('error', 'Budget not found');
    }

    public function destroy(string $id, Request $request)
    {
        $request->validate([

        ]);

        $requests = BudgetRequest::find($id);
        if ($requests) {
            $requests->delete();
            return redirect()->route('' . $this->roles() . '.new.budget')->with('success', 'Budget deleted successfully');
        }

        return redirect()->back()->with('error', 'Budget not found');
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
            $filter = BudgetRequest::where('budget_department', auth()->user()->department_code)
                ->where(function ($query) use ($search) {
                    $query->where('budget_name', 'like', '%' . $search . '%')
                        ->orWhere('budget_code', 'like', '%' . $search . '%')
                        ->orWhere('budget_amount', 'like', '%' . $search . '%')
                        ->orWhere('budget_category', 'like', '%' . $search . '%')
                        ->orWhere('budget_period', 'like', '%' . $search . '%')
                        ->orWhere('budget_justification', 'like', '%' . $search . '%')
                        ->orWhere('budget_status', 'like', '%' . $search . '%')
                        ->orWhere('budget_approvedBy', 'like', '%' . $search . '%')
                        ->orWhere('budget_approvedAmount', 'like', '%' . $search . '%')
                        ->orWhere('budget_approvedDate', 'like', '%' . $search . '%')
                        ->orWhere('budget_notes', 'like', '%' . $search . '%');
                });
        } else {
            $filter = BudgetRequest::where('budget_department', 'like', '%' . $search . '%')
                ->orWhere('budget_name', 'like', '%' . $search . '%')
                ->orWhere('budget_code', 'like', '%' . $search . '%')
                ->orWhere('budget_amount', 'like', '%' . $search . '%')
                ->orWhere('budget_category', 'like', '%' . $search . '%')
                ->orWhere('budget_period', 'like', '%' . $search . '%')
                ->orWhere('budget_justification', 'like', '%' . $search . '%')
                ->orWhere('budget_status', 'like', '%' . $search . '%')
                ->orWhere('budget_approvedBy', 'like', '%' . $search . '%')
                ->orWhere('budget_approvedAmount', 'like', '%' . $search . '%')
                ->orWhere('budget_approvedDate', 'like', '%' . $search . '%')
                ->orWhere('budget_notes', 'like', '%' . $search . '%');
        }
        $data = [
            'users' => User::all(),
            'status' => Status::all(),
            'categories' => Categories::all(),
            'departments' => Department::all(),
            'periods' => Period::all(),
            'budgets' => $filter->get(),
        ];

        return view('board.new.budgets.index', $data);
    }

}
