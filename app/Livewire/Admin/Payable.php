<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Old\Payable as Modelpayable;
use App\Models\Department;
use App\Models\PlanCategories;

class Payable extends Component
{

    public $payable_info;
    public $payable_amount;
    public $payable_department;
    public $payable_name;
    public $payable_category;
    public $payable_date;

    public $terms;

    public $isOpen = 1;
    public $payableId;
    public $search;

    public $dept;

    protected $rules = [
        'payable_info' => 'required',
        'payable_amount' => 'required',
        'payable_department' => 'required',
        'payable_name' => 'required',
        'payable_category' => 'required',
        'payable_date' => 'required',


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

        Modelpayable::create([
            'payable_info' => $this->payable_info,
            'payable_amount' => $this->payable_amount,
            'payable_department' => $this->payable_department,
            'payable_name' => $this->payable_name,
            'payable_category' => $this->payable_category,
            'payable_date' => date('Y-m-d', strtotime($this->payable_date)),

            'payable_type' => 'T6',
        ]);

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'payable created successfully',
        ]);

        $this->openModal();

        $this->reset();
    }

    public function edit($id)
    {
        $payable = Modelpayable::findOrFail($id);
        $this->payableId = $id;
        $this->payable_info = $payable->payable_info;
        $this->payable_amount = $payable->payable_amount;
        $this->payable_department = $payable->payable_department;
        $this->payable_name = $payable->payable_name;
        $this->payable_category = $payable->payable_category;
        $this->payable_date = $payable->payable_date;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->payableId) {
            $payable = Modelpayable::findOrFail($this->payableId);
            $payable->update([
                'payable_info' => $this->payable_info,
                'payable_department' => $this->payable_department,
                'payable_name' => $this->payable_name,
                'payable_category' => $this->payable_category,
                'payable_date' => date('Y-m-d', strtotime($this->payable_date)),
                'payable_amount' => $this->payable_amount,
            ]);


            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'payable updated successfully',
            ]);


            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        Modelpayable::find($id)->delete();

        $data = [
            'message' => 'payable deleted successfully',
            'status' => 'danger',
        ];
        $this->dispatch('notify', $data);

        $this->reset();
    }


    public function render()
    {
        $result = [] ?: Modelpayable::all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = Modelpayable::where('payable_info', 'like', '%' . $search . '%')
                ->orwhere('payable_amount', 'like', '%' . $search . '%')
                ->orWhere('payable_name', 'like', '%' . $search . '%')
                ->orWhere('payable_category', 'like', '%' . $search . '%')
                ->orWhere('payable_date', 'like', '%' . $search . '%')
                ->orWhere('payable_department', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => PlanCategories::where('category_type', 'T6')->get(),
            'payable' => $result,
        ];

        return view('livewire.admin.payable', $data);
    }
}
