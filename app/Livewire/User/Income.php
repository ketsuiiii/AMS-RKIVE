<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Old\Income as Modelincome;
use App\Models\Department;
use App\Models\PlanCategories;

class Income extends Component
{

    public $income_info;
    public $income_amount;
    public $income_department;
    public $income_name;
    public $income_category;
    public $income_date;

    public $terms;

    public $isOpen = 1;
    public $incomeId;
    public $search;

    public $dept;

    protected $rules = [
        'income_info' => 'required',
        'income_amount' => 'required',
        'income_department' => 'required',
        'income_name' => 'required',
        'income_category' => 'required',
        'income_date' => 'required',


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

        Modelincome::create([
            'income_info' => $this->income_info,
            'income_amount' => $this->income_amount,
            'income_department' => $this->income_department,
            'income_name' => $this->income_name,
            'income_category' => $this->income_category,
            'income_date' => date('Y-m-d', strtotime($this->income_date)),

            'income_type' => 'T4',
        ]);

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'income created successfully',
        ]);

        $this->openModal();

        $this->reset();
    }

    public function edit($id)
    {
        $income = Modelincome::findOrFail($id);
        $this->incomeId = $id;
        $this->income_info = $income->income_info;
        $this->income_amount = $income->income_amount;
        $this->income_department = $income->income_department;
        $this->income_name = $income->income_name;
        $this->income_category = $income->income_category;
        $this->income_date = $income->income_date;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->incomeId) {
            $income = Modelincome::findOrFail($this->incomeId);
            $income->update([
                'income_info' => $this->income_info,
                'income_department' => $this->income_department,
                'income_name' => $this->income_name,
                'income_category' => $this->income_category,
                'income_date' => date('Y-m-d', strtotime($this->income_date)),
                'income_amount' => $this->income_amount,
            ]);

            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'income updated successfully',
            ]);


            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        Modelincome::find($id)->delete();

        $data = [
            'message' => 'income deleted successfully',
            'status' => 'danger',
        ];
        $this->dispatch('notify', $data);

        $this->reset();
    }


    public function render()
    {
        $result = [] ?: Modelincome::all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = Modelincome::where('income_info', 'like', '%' . $search . '%')
                ->orwhere('income_amount', 'like', '%' . $search . '%')
                ->orWhere('income_name', 'like', '%' . $search . '%')
                ->orWhere('income_category', 'like', '%' . $search . '%')
                ->orWhere('income_date', 'like', '%' . $search . '%')
                ->orWhere('income_department', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => PlanCategories::where('category_type', 'T4')->get(),
            'income' => $result,
        ];

        return view('livewire.user.income', $data);
    }
}
