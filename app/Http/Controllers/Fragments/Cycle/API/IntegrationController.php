<?php

namespace App\Http\Controllers\Fragments\Cycle\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Department;
use App\Models\Categories;
use App\Models\Status;
use App\Models\User;
use App\Models\Period;
use App\Models\Optional;
use App\Models\Allocation;

use App\Mail\EmailController;
use Illuminate\Support\Facades\Mail;

use App\Models\BudgetRequest;
use App\Models\AddBudgetRequest;



class IntegrationController extends Controller
{
    public function BR()
    {
        $tutorial = [
            '======================================',
            'Hello, welcome to budget request. Please fill up the form below.',
            '======================================',
            'Required fields are marked with an asterisk (*).',
            '* budget_createdBy is the name of the person who created the budget request.',
            '* budget_email is the email of the person who created the budget request. (please provide a valid email)',
            '* budget_name is the plan name of the budget request.',
            '* budget_amount(numeric) is the amount needed for this budget request.',
            '* budget_department is the plan department of the budget request. (check the departments table, use the department code for your specific department)',
            '* budget_justification is the plan justification or why this plan is requested.',
            '* budget_date is the plan date of the budget request.',
            '* budget_category is the plan category of the budget request.(check the categories table)',
            '* budget_supportingDocumentation(file|pdf,doc,docx) is the plan supporting documentation of the budget request.',

            'For budget_status, check the status table.',
            'For budget_department, check the department table.',
            'For budget_approvedBy, check the user table.',
            '======================================',
        ];

        $data = [
            'tutorial' => $tutorial,
            'budgets' => BudgetRequest::all(),
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'periods' => Period::all(),
        ];

        return response()->json($data);
    }

    public function BRP(Request $request)
    {
        dd($request);
        $department = $request->budget_department;

        if ($request->has('budget_supportingDocumentation')) {

            $file = $request->file('budget_supportingDocumentation');
            $extension = $file->getClientOriginalExtension();

            $fileName = uniqid() . '.' . $extension;

            $path = 'uploads/category/budgets/';
            $filePath = $file->move($path, $fileName);
        }
        // return response()->json($request->all());

        $check = BudgetRequest::create([
            'budget_code' => 'BC' . uniqid(),
            'budget_createdBy' => $request->budget_createdBy,
            'budget_name' => $request->budget_name,
            'budget_amount' => $request->budget_amount,
            'budget_justification' => $request->budget_justification,
            'budget_date' => date('Y-m-d', strtotime($request->budget_date)),
            'budget_category' => $request->budget_category,
            'budget_department' => $department,
            'budget_period' => 'A1',
            'budget_optional' => 'N',

            // DOCUMENTATION
            'budget_supportingDocumentationName' => $fileName,
            'budget_supportingDocumentation' => $filePath,

            'budget_status' => 'S2',
            'budget_type' => 'R1',
            'budget_email' => $request->budget_email,
        ]);

        $data = [
            'code' => $check->budget_code,
            'mailTo' => $request->budget_email,
            'mailType' => 'R1',
            'mailStatus' => 'S2',
        ];

        if ($check) {
            $this->mailResponse($data);
            $message = 'Budget request created successfully';
        } else {
            $message = 'Budget request failed to create';
        }
        return response()->json($message);
    }

    public function ABR()
    {
        $tutorial = [
            '======================================',
            'Hello, welcome to additional budget request. Please fill up the form below.',
            '======================================',
            'Required fields are marked with an asterisk (*).',
            '* request_createdBy is the name of the person who created the additional budget request.',
            '* request_email is the email of the person who created the additional budget request. (please provide a valid email)',
            '* request_name is the plan name of the additional budget request.',
            '* request_amount(numeric) the amount needed for this additional budget request.',
            '* request_period is the plan period of the additional budget request. (check the periods table)',
            '* request_date is the plan date of the additional budget request.',
            '* request_projectDetails is id from the budget request table. (check the additional budgets table)',
            '* request_category is the plan category of the additional budget request.(check the categories table)',
            '* request_supportingDocumentation(file|pdf,doc,docx) is the plan supporting documentation of the additional budget request.',

            'For request_status, check the status table.',
            'For request_department, check the department table.',
            'For request_approvedBy, check the user table.',
            '======================================',
        ];

        $data = [
            'tutorial' => $tutorial,
            'requests' => AddBudgetRequest::all(),
            'budgets' => BudgetRequest::all(),
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'periods' => Period::all(),
        ];

        return response()->json($data);

    }

    public function ABRP(Request $request)
    {
        // Find the budget's approved amount from the database
        $request_budget_code = BudgetRequest::where('id', $request->request_projectDetails)->get();
        $request_budgetApproved = str_replace(',', '', $request_budget_code[0]->budget_approvedAmount);
        $request_budgetDepartment = $request_budget_code[0]->budget_department;

        // Add the approved amount with the actual spending and convert it to a number
        $request_actualSpending = $request_budgetApproved + (float) $request->request_amount;

        if ($request->has('request_supportingDocumentation')) {

            $file = $request->file('request_supportingDocumentation');
            $extension = $file->getClientOriginalExtension();

            $fileName = uniqid() . '.' . $extension;

            $path = 'uploads/category/addbudgets/';
            $filePath = $file->move($path, $fileName);
        }

        $check = AddBudgetRequest::create([
            'request_code' => 'RC' . uniqid(),
            'request_createdBy' => $request->request_createdBy,
            'request_name' => $request->request_name,
            'request_department' => $request_budgetDepartment,
            'request_amount' => $request->request_amount,
            'request_category' => $request->request_category,
            'request_date' => date('Y-m-d', strtotime($request->request_date)),
            'request_projectDetails' => $request->request_projectDetails,
            'request_period' => 'A1',
            'request_optional' => 'N',

            'request_actualSpending' => $request_actualSpending,
            'request_justification' => $request->request_justification,

            'request_status' => 'S2',
            'request_type' => 'R2',

            // DOCUMENTATION
            'request_supportingDocumentationName' => $fileName,
            'request_supportingDocumentation' => $filePath,
            'request_email' => $request->request_email,
        ]);


        $data = [
            'code' => $check->request_code,
            'mailTo' => $request->request_email,
            'mailType' => 'R2',
            'mailStatus' => 'S2',
        ];

        if ($check) {
            $this->mailResponse($data);
            $message = 'Budget request created successfully';
        } else {
            $message = 'Budget request failed to create';
        }
        return response()->json($message);
    }

    public function mailResponse($data)
    {
        $id = $data['code'];
        $mailType = $data['mailType'];
        $mailTo = $data['mailTo'];
        $mailStatus = $data['mailStatus'];

        // $id = '3';
        // $mailType = 'R1';
        // $mailTo = 'creepings.12@gmail.com';
        // $mailStatus = 'S3';
        // dd($data);
        if ($mailType == 'R1') {
            if ($mailStatus == 'S1') {
                $viewBoard = 'board.new.email.budget';
                $subjectName = 'Your request for budget has been approved';
                $title = 'Budget Request Details';
            } elseif ($mailStatus == 'S3') {
                $viewBoard = 'board.new.email.budget';
                $subjectName = 'Your request for budget has been rejected';
                $title = 'Budget Request Details';
            } elseif ($mailStatus == 'S2') {
                $viewBoard = 'board.new.email.budget';
                $subjectName = 'Copy of your request for budget';
                $title = 'Budget Request Details';
            }
            $filter = BudgetRequest::where('budget_code', $id)->get();

            $mailData = [
                'viewBoard' => $viewBoard,
                'subjectName' => $subjectName,
                'title' => $title . ' - ' . $filter[0]->budget_name,
                'items' => $filter[0],
            ];

            Mail::to($mailTo)->send(new EmailController($mailData));
            return response()->json('Email send successfully.');
        }
        if ($mailType == 'R2') {
            if ($mailStatus == 'S1') {
                $viewBoard = 'board.new.email.addbudget';
                $subjectName = 'Your request for additional budget has been approved';
                $title = 'Additional Budget Request Details';
            } elseif ($mailStatus == 'S3') {
                $viewBoard = 'board.new.email.addbudget';
                $subjectName = 'Your request for additional budget has been rejected';
                $title = 'Additional Budget Request Details';
            } elseif ($mailStatus == 'S2') {
                $viewBoard = 'board.new.email.addbudget';
                $subjectName = 'Copy of your request for additional budget';
                $title = 'Additional Budget Request Details';
            }

            $filter = AddBudgetRequest::where('request_code', $id)->get();

            $mailData = [
                'viewBoard' => $viewBoard,
                'subjectName' => $subjectName,
                'title' => $title . ' - ' . $filter[0]->request_name,
                'items' => $filter[0],
            ];

            Mail::to($mailTo)->send(new EmailController($mailData));
            return response()->json('Email send successfully.');
        }
    }

    public function track()
    {

        $data = [
            'requests' => AddBudgetRequest::all(),
            'budgets' => BudgetRequest::all(),
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'periods' => Period::all(),
            'type' => 'R0',
        ];

        return view('board.new.email.track', $data);
    }
    public function search(Request $request)
    {
        $search = $request->search;

        if (Str::startsWith($search, 'RC')) {
            $filter = AddBudgetRequest::where('request_code', 'like', '%' . $search . '%')->get();
            $type = 'R2';
        } elseif (Str::startsWith($search, 'BC')) {
            $filter = BudgetRequest::where('budget_code', 'like', '%' . $search . '%')->get();
            $type = 'R1';
        } else {
            $filter = '0';
            $type = 'R0';
        }

        $data = [
            'requests' => $filter,
            'type' => $type,
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'periods' => Period::all(),
        ];

        return view('board.new.email.track', $data);
    }

    public function USR()
    {
        return view('board.new.email.users');
    }

}
