<?php

namespace App\Livewire\Admin;

use App\Models\Old\Budget as Budgets;
use App\Models\Categories;
use App\Models\Department;
use App\Models\Status;
use App\Models\User;

use Livewire\Component;

class Budget extends Component
{

    public $budget_name;
    public $budget_department;
    public $budget_amount;
    public $budget_category;
    public $budget_startDate;
    public $budget_endDate;
    public $budget_description;

    public $budget_status;
    public $budget_approvedBy;
    public $budget_approvedAmount;
    public $budget_approvedDate;
    public $budget_notes;
    public $terms;

    public $isOpen = 1;
    public $budgetId;
    public $search;

    public $dept;

    protected $rules = [
        'budget_name' => 'required',
        'budget_department' => 'required',
        'budget_amount' => 'required',
        'budget_category' => 'required',
        'budget_startDate' => 'required',
        'budget_endDate' => 'required',
        'budget_description' => 'required',

        'budget_status' => 'required',
        'budget_approvedBy' => 'required',
        'budget_approvedAmount' => 'required',
        'budget_approvedDate' => 'required',
        'budget_notes' => 'required',

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
        Budgets::create([
            'budget_name' => $this->budget_name,
            'budget_department' => $this->budget_department,
            'budget_amount' => $this->budget_amount,
            'budget_category' => $this->budget_category,
            'budget_startDate' => date('Y-m-d', strtotime($this->budget_startDate)),
            'budget_endDate' => date('Y-m-d', strtotime($this->budget_endDate)),
            'budget_description' => $this->budget_description,

            'budget_status' => $this->budget_status,
            'budget_approvedBy' => $this->budget_approvedBy,
            'budget_approvedAmount' => $this->budget_approvedAmount,
            'budget_approvedDate' => date('Y-m-d', strtotime($this->budget_approvedDate)),
            'budget_notes' => $this->budget_notes,

            'budget_type' => 'T1',
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
        $budget = Budgets::findOrFail($id);
        $this->budgetId = $id;
        $this->budget_name = $budget->budget_name;
        $this->budget_department = $budget->budget_department;
        $this->budget_amount = $budget->budget_amount;
        $this->budget_category = $budget->budget_category;
        $this->budget_startDate = $budget->budget_startDate;
        $this->budget_endDate = $budget->budget_endDate;
        $this->budget_description = $budget->budget_description;

        $this->budget_status = $budget->budget_status;
        $this->budget_approvedBy = $budget->budget_approvedBy;
        $this->budget_approvedAmount = $budget->budget_approvedAmount;
        $this->budget_approvedDate = $budget->budget_approvedDate;
        $this->budget_notes = $budget->budget_notes;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->budgetId) {
            $budget = Budgets::findOrFail($this->budgetId);
            $budget->update([
                'budget_name' => $this->budget_name,
                'budget_department' => $this->budget_department,
                'budget_amount' => $this->budget_amount,
                'budget_category' => $this->budget_category,
                'budget_startDate' => date('Y-m-d', strtotime($this->budget_startDate)),
                'budget_endDate' => date('Y-m-d', strtotime($this->budget_endDate)),
                'budget_description' => $this->budget_description,

                'budget_status' => $this->budget_status,
                'budget_approvedBy' => $this->budget_approvedBy,
                'budget_approvedAmount' => $this->budget_approvedAmount,
                'budget_approvedDate' => date('Y-m-d', strtotime($this->budget_approvedDate)),
                'budget_notes' => $this->budget_notes,
            ]);


            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'Budget updated successfully',
            ]);


            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        Budgets::find($id)->delete();
        session()->flash('success', 'Budget deleted successfully.');
        $data = [
            'message' => 'Post deleted successfully',
            'status' => 'danger',
        ];
        $this->dispatch('notify', $data);

        $this->reset();
    }


    public function render()
    {
        $result = [] ?: Budgets::all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = Budgets::where('budget_department', 'like', '%' . $search . '%')
                ->orwhere('budget_name', 'like', '%' . $search . '%')
                ->orWhere('budget_amount', 'like', '%' . $search . '%')
                ->orWhere('budget_category', 'like', '%' . $search . '%')
                ->orWhere('budget_startDate', 'like', '%' . $search . '%')
                ->orWhere('budget_endDate', 'like', '%' . $search . '%')
                ->orWhere('budget_description', 'like', '%' . $search . '%')
                ->orWhere('budget_status', 'like', '%' . $search . '%')
                ->orWhere('budget_approvedBy', 'like', '%' . $search . '%')
                ->orWhere('budget_approvedAmount', 'like', '%' . $search . '%')
                ->orWhere('budget_approvedDate', 'like', '%' . $search . '%')
                ->orWhere('budget_notes', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => Categories::all(),
            'status' => Status::all(),
            'users' => User::all(),
            'budgets' => $result,
        ];

        return view('livewire.admin.budget', $data);
    }


    // public function mount($dept)
    // {
    //     $this->dept = $dept;
    // }

    // public function render()
    // {
    //     $dept = $this->dept;
    //     $search = $this->search;

    //     $query = Budgets::query();

    //     if ($dept) {
    //         $query->where('budget_department', $dept);
    //     }

    //     if ($search) {
    //         $query->where(function ($q) use ($search) {
    //             $q->where('budget_name', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_amount', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_category', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_startDate', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_endDate', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_description', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_status', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_approvedBy', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_approvedAmount', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_approvedDate', 'like', '%' . $search . '%')
    //                 ->orWhere('budget_notes', 'like', '%' . $search . '%');
    //         });
    //     }

    //     $budgets = $query->get();

    //     $data = [
    //         'departments' => Department::all(),
    //         'categories' => Categories::all(),
    //         'status' => Status::all(),
    //         'users' => User::all(),
    //         'budgets' => $budgets,
    //     ];

    //     return view('livewire.admin.budget', $data);
    // }

}
