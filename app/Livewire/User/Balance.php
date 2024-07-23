<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Old\Balance as Modelbalance;
use App\Models\Department;
use App\Models\PlanCategories;

class Balance extends Component
{

    public $balance_info;
    public $balance_amount;
    public $balance_department;
    public $balance_name;
    public $balance_category;
    public $balance_date;

    public $terms;

    public $isOpen = 1;
    public $balanceId;
    public $search;

    public $dept;

    protected $rules = [
        'balance_info' => 'required',
        'balance_amount' => 'required',
        'balance_department' => 'required',
        'balance_name' => 'required',
        'balance_category' => 'required',
        'balance_date' => 'required',


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

        Modelbalance::create([
            'balance_info' => $this->balance_info,
            'balance_amount' => $this->balance_amount,
            'balance_department' => $this->balance_department,
            'balance_name' => $this->balance_name,
            'balance_category' => $this->balance_category,
            'balance_date' => date('Y-m-d', strtotime($this->balance_date)),

            'balance_type' => 'T5',
        ]);


        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'balance created successfully',
        ]);

        $this->openModal();

        $this->reset();
    }

    public function edit($id)
    {
        $balance = Modelbalance::findOrFail($id);
        $this->balanceId = $id;
        $this->balance_info = $balance->balance_info;
        $this->balance_amount = $balance->balance_amount;
        $this->balance_department = $balance->balance_department;
        $this->balance_name = $balance->balance_name;
        $this->balance_category = $balance->balance_category;
        $this->balance_date = $balance->balance_date;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->balanceId) {
            $balance = Modelbalance::findOrFail($this->balanceId);
            $balance->update([
                'balance_info' => $this->balance_info,
                'balance_department' => $this->balance_department,
                'balance_name' => $this->balance_name,
                'balance_category' => $this->balance_category,
                'balance_date' => date('Y-m-d', strtotime($this->balance_date)),
                'balance_amount' => $this->balance_amount,
            ]);


            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'balance updated successfully',
            ]);


            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        Modelbalance::find($id)->delete();

        $data = [
            'message' => 'balance deleted successfully',
            'status' => 'danger',
        ];
        $this->dispatch('notify', $data);

        $this->reset();
    }


    public function render()
    {
        $result = [] ?: Modelbalance::all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = Modelbalance::where('balance_info', 'like', '%' . $search . '%')
                ->orwhere('balance_amount', 'like', '%' . $search . '%')
                ->orWhere('balance_name', 'like', '%' . $search . '%')
                ->orWhere('balance_category', 'like', '%' . $search . '%')
                ->orWhere('balance_date', 'like', '%' . $search . '%')
                ->orWhere('balance_department', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => PlanCategories::where('category_type', 'T5')->get(),
            'balance' => $result,
        ];

        return view('livewire.user.balance', $data);
    }
}
