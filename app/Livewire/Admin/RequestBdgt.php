<?php

namespace App\Livewire\Admin;

use App\Models\Old\AddBudgets;
use App\Models\Old\Budget;
use App\Models\Categories;
use App\Models\Department;
use App\Models\Status;
use App\Models\User;
use Livewire\Component;

class RequestBdgt extends Component
{  public $request_name;
    public $request_department;
    public $request_amount;
    public $request_category;
    public $request_description;

    public $request_budget_code;
    public $request_actualSpending;
    public $request_variance;
    public $request_varianceReason;

    public $request_status;
    public $request_approvedBy;
    public $request_approvedAmount;
    public $request_approvedDate;
    public $request_notes;
    public $terms;

    public $isOpen = 1;
    public $requestId;
    public $search = '';

    protected $rules = [
        'request_name' => 'required',
        'request_department' => 'required',
        'request_amount' => 'required',
        'request_category' => 'required',
        'request_description' => 'required',

        'request_budget_code' => 'required',
        'request_actualSpending' => 'required',
        'request_variance' => 'required',
        'request_varianceReason' => 'required',

        'request_status' => 'required',
        'request_approvedBy' => 'required',
        'request_approvedAmount' => 'required',
        'request_approvedDate' => 'required',
        'request_notes' => 'required',

    ];

    public function create()
    {
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate();
        AddBudgets::create([
            'request_name' => $this->request_name,
            'request_department' => $this->request_department,
            'request_amount' => $this->request_amount,
            'request_category' => $this->request_category,
            'request_description' => $this->request_description,

            'request_budget_code' => $this->request_budget_code,
            'request_actualSpending' => $this->request_actualSpending,
            'request_variance' => $this->request_variance,
            'request_varianceReason' => $this->request_varianceReason,

            'request_status' => $this->request_status,
            'request_approvedBy' => $this->request_approvedBy,
            'request_approvedAmount' => $this->request_approvedAmount,
            'request_approvedDate' => date('Y-m-d', strtotime($this->request_approvedDate)),
            'request_notes' => $this->request_notes,

            'request_type' => 'T2',
        ]);

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'Budget created successfully',
        ]);

        $this->openModal();

        $this->reset();
    }

    public function edit($id)
    {
        $budget = AddBudgets::find($id);
        $this->requestId = $id;
        $this->request_name = $budget->request_name;
        $this->request_department = $budget->request_department;
        $this->request_amount = $budget->request_amount;
        $this->request_category = $budget->request_category;
        $this->request_description = $budget->request_description;

        $this->request_budget_code = $budget->request_budget_code;
        $this->request_actualSpending = $budget->request_actualSpending;
        $this->request_variance = $budget->request_variance;
        $this->request_varianceReason = $budget->request_varianceReason;

        $this->request_status = $budget->request_status;
        $this->request_approvedBy = $budget->request_approvedBy;
        $this->request_approvedAmount = $budget->request_approvedAmount;
        $this->request_approvedDate = $budget->request_approvedDate;
        $this->request_notes = $budget->request_notes;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->requestId) {
            $budget = AddBudgets::findOrFail($this->requestId);
            $budget->update([
                'request_name' => $this->request_name,
                'request_department' => $this->request_department,
                'request_amount' => $this->request_amount,
                'request_category' => $this->request_category,
                'request_description' => $this->request_description,

                'request_budget_code' => $this->request_budget_code,
                'request_actualSpending' => $this->request_actualSpending,
                'request_variance' => $this->request_variance,
                'request_varianceReason' => $this->request_varianceReason,

                'request_status' => $this->request_status,
                'request_approvedBy' => $this->request_approvedBy,
                'request_approvedAmount' => $this->request_approvedAmount,
                'request_approvedDate' => date('Y-m-d', strtotime($this->request_approvedDate)),
                'request_notes' => $this->request_notes,
            ]);


            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'Budget updated successfully',
            ]);
            session()->flash('success', 'Budget updated successfully.');

            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        AddBudgets::find($id)->delete();


        $this->dispatch('notify', [
            'status' => 'danger',
            'message' => 'Budget deleted successfully',
        ]);

        $this->reset();
    }

    public function render()
    {
        $result = [] ?: AddBudgets::all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = AddBudgets::where('request_department', 'like', '%' . $search . '%')
                ->orwhere('request_name', 'like', '%' . $search . '%')
                ->orWhere('request_amount', 'like', '%' . $search . '%')
                ->orWhere('request_category', 'like', '%' . $search . '%')
                ->orWhere('request_description', 'like', '%' . $search . '%')
                ->orWhere('request_budget_code', 'like', '%' . $search . '%')
                ->orWhere('request_actualSpending', 'like', '%' . $search . '%')
                ->orWhere('request_variance', 'like', '%' . $search . '%')
                ->orWhere('request_varianceReason', 'like', '%' . $search . '%')
                ->orWhere('request_status', 'like', '%' . $search . '%')
                ->orWhere('request_approvedBy', 'like', '%' . $search . '%')
                ->orWhere('request_approvedAmount', 'like', '%' . $search . '%')
                ->orWhere('request_approvedDate', 'like', '%' . $search . '%')
                ->orWhere('request_notes', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'budgets' => Budget::all(),
            'requests' => $result,
        ];


        return view('livewire.admin.addbudget', $data);
    }
}
