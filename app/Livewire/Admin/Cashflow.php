<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Old\Cashflow as Modelcashflow;
use App\Models\Department;
use App\Models\PlanCategories;

class Cashflow extends Component
{

    public $cashflow_info;
    public $cashflow_amount;
    public $cashflow_department;
    public $cashflow_name;
    public $cashflow_category;
    public $cashflow_date;

    public $terms;

    public $isOpen = 1;
    public $cashflowId;
    public $search;

    public $dept;

    protected $rules = [
        'cashflow_info' => 'required',
        'cashflow_amount' => 'required',
        'cashflow_department' => 'required',
        'cashflow_name' => 'required',
        'cashflow_category' => 'required',
        'cashflow_date' => 'required',


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

        Modelcashflow::create([
            'cashflow_info' => $this->cashflow_info,
            'cashflow_amount' => $this->cashflow_amount,
            'cashflow_department' => $this->cashflow_department,
            'cashflow_name' => $this->cashflow_name,
            'cashflow_category' => $this->cashflow_category,
            'cashflow_date' => date('Y-m-d', strtotime($this->cashflow_date)),

            'cashflow_type' => 'T3',
        ]);


        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'cashflow created successfully',
        ]);

        $this->openModal();

        $this->reset();
    }

    public function edit($id)
    {
        $cashflow = Modelcashflow::findOrFail($id);
        $this->cashflowId = $id;
        $this->cashflow_info = $cashflow->cashflow_info;
        $this->cashflow_amount = $cashflow->cashflow_amount;
        $this->cashflow_department = $cashflow->cashflow_department;
        $this->cashflow_name = $cashflow->cashflow_name;
        $this->cashflow_category = $cashflow->cashflow_category;
        $this->cashflow_date = $cashflow->cashflow_date;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->cashflowId) {
            $cashflow = Modelcashflow::findOrFail($this->cashflowId);
            $cashflow->update([
                'cashflow_info' => $this->cashflow_info,
                'cashflow_department' => $this->cashflow_department,
                'cashflow_name' => $this->cashflow_name,
                'cashflow_category' => $this->cashflow_category,
                'cashflow_date' => date('Y-m-d', strtotime($this->cashflow_date)),
                'cashflow_amount' => $this->cashflow_amount,
            ]);

            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'cashflow updated successfully',
            ]);


            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        Modelcashflow::find($id)->delete();

        $data = [
            'message' => 'cashflow deleted successfully',
            'status' => 'danger',
        ];
        $this->dispatch('notify', $data);

        $this->reset();
    }


    public function render()
    {
        $result = [] ?: Modelcashflow::all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = Modelcashflow::where('cashflow_info', 'like', '%' . $search . '%')
                ->orwhere('cashflow_amount', 'like', '%' . $search . '%')
                ->orWhere('cashflow_name', 'like', '%' . $search . '%')
                ->orWhere('cashflow_category', 'like', '%' . $search . '%')
                ->orWhere('cashflow_date', 'like', '%' . $search . '%')
                ->orWhere('cashflow_department', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => PlanCategories::where('category_type', 'T3')->get(),
            'cashflow' => $result,
        ];

        return view('livewire.admin.cashflow', $data);
    }
}
