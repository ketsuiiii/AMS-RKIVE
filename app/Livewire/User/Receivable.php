<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Old\Recievable as ModelRecievable;
use App\Models\Department;
use App\Models\PlanCategories;

class Receivable extends Component
{

    public $recievable_info;
    public $recievable_amount;
    public $recievable_department;
    public $recievable_name;
    public $recievable_category;
    public $recievable_invoice_date;
    public $recievable_due_date;

    public $terms;

    public $isOpen = 1;
    public $recievableId;
    public $search;

    public $dept;

    protected $rules = [
        'recievable_info' => 'required',
        'recievable_amount' => 'required',
        'recievable_department' => 'required',
        'recievable_name' => 'required',
        'recievable_category' => 'required',
        'recievable_invoice_date' => 'required',
        'recievable_due_date' => 'required',


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

        ModelRecievable::onConnection1()->create([
            'recievable_info' => $this->recievable_info,
            'recievable_amount' => $this->recievable_amount,
            'recievable_department' => $this->recievable_department,
            'recievable_name' => $this->recievable_name,
            'recievable_category' => $this->recievable_category,
            'recievable_invoice_date' => date('Y-m-d', strtotime($this->recievable_invoice_date)),
            'recievable_due_date' => $this->recievable_due_date,

            'recievable_type' => 'T8',
        ]);

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'Recievable created successfully',
        ]);

        $this->openModal();

        $this->reset();
    }

    public function edit($id)
    {
        $recievable = ModelRecievable::findOrFail($id);
        $this->recievableId = $id;
        $this->recievable_info = $recievable->recievable_info;
        $this->recievable_amount = $recievable->recievable_amount;
        $this->recievable_department = $recievable->recievable_department;
        $this->recievable_name = $recievable->recievable_name;
        $this->recievable_category = $recievable->recievable_category;
        $this->recievable_invoice_date = $recievable->recievable_invoice_date;
        $this->recievable_due_date = $recievable->recievable_due_date;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->recievableId) {
            $recievable = ModelRecievable::findOrFail($this->recievableId);
            $recievable->update([
                'recievable_info' => $this->recievable_info,
                'recievable_department' => $this->recievable_department,
                'recievable_name' => $this->recievable_name,
                'recievable_category' => $this->recievable_category,
                'recievable_invoice_date' => date('Y-m-d', strtotime($this->recievable_invoice_date)),
                'recievable_due_date' => $this->recievable_due_date,
                'recievable_amount' => $this->recievable_amount,
            ]);

            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'Recievable updated successfully',
            ]);


            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        ModelRecievable::find($id)->delete();

        $data = [
            'message' => 'Recievable deleted successfully',
            'status' => 'danger',
        ];
        $this->dispatch('notify', $data);

        $this->reset();
    }


    public function render()
    {
        $result = [] ?: ModelRecievable::onConnection1()->all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = ModelRecievable::onConnection1()->where('recievable_info', 'like', '%' . $search . '%')
                ->orwhere('recievable_amount', 'like', '%' . $search . '%')
                ->orWhere('recievable_name', 'like', '%' . $search . '%')
                ->orWhere('recievable_category', 'like', '%' . $search . '%')
                ->orWhere('recievable_invoice_date', 'like', '%' . $search . '%')
                ->orWhere('recievable_due_date', 'like', '%' . $search . '%')
                ->orWhere('recievable_department', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::onConnection1()->all(),
            'categories' => PlanCategories::onConnection1()->where('category_type', 'T7')->get(),
            'recievable' => $result,
        ];

        return view('livewire.user.recievable', $data);
    }
}
