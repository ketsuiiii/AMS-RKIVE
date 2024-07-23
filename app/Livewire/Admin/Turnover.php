<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Department;
use App\Models\PlanCategories;
use App\Models\Old\Turnover as ModelTurnover;

class Turnover extends Component
{

    public $turnover_info;
    public $turnover_product_name;
    public $turnover_department;
    public $turnover_cost_of_goods_sold;
    public $turnover_category;
    public $turnover_inventory_turnover_ratio;
    public $turnover_date;
    public $terms;

    public $isOpen = 1;
    public $turnoverId;
    public $search;

    public $dept;

    protected $rules = [
        'turnover_info' => 'required',
        'turnover_product_name' => 'required',
        'turnover_department' => 'required',
        'turnover_cost_of_goods_sold' => 'required',
        'turnover_category' => 'required',
        'turnover_inventory_turnover_ratio' => 'required',
        'turnover_date' => 'required',

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

        ModelTurnover::create([
            'turnover_product_name' => $this->turnover_product_name,
            'turnover_department' => $this->turnover_department,
            'turnover_cost_of_goods_sold' => $this->turnover_cost_of_goods_sold,
            'turnover_category' => $this->turnover_category,
            'turnover_inventory_turnover_ratio' => $this->turnover_inventory_turnover_ratio,
            'turnover_date' => date('Y-m-d', strtotime($this->turnover_date)),
            'turnover_info' => $this->turnover_info,

            'turnover_type' => 'T8',
        ]);

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'turnover created successfully',
        ]);

        $this->openModal();

        $this->reset();
    }

    public function edit($id)
    {
        $turnover = ModelTurnover::findOrFail($id);
        $this->turnoverId = $id;
        $this->turnover_info = $turnover->turnover_info;
        $this->turnover_product_name = $turnover->turnover_product_name;
        $this->turnover_department = $turnover->turnover_department;
        $this->turnover_cost_of_goods_sold = $turnover->turnover_cost_of_goods_sold;
        $this->turnover_category = $turnover->turnover_category;
        $this->turnover_inventory_turnover_ratio = $turnover->turnover_inventory_turnover_ratio;
        $this->turnover_date = $turnover->turnover_date;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->turnoverId) {
            $turnover = ModelTurnover::findOrFail($this->turnoverId);
            $turnover->update([
                'turnover_info' => $this->turnover_info,
                'turnover_department' => $this->turnover_department,
                'turnover_cost_of_goods_sold' => $this->turnover_cost_of_goods_sold,
                'turnover_category' => $this->turnover_category,
                'turnover_inventory_turnover_ratio' => $this->turnover_inventory_turnover_ratio,
                'turnover_date' => date('Y-m-d', strtotime($this->turnover_date)),
                'turnover_product_name' => $this->turnover_product_name,
            ]);

            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'turnover updated successfully',
            ]);


            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        ModelTurnover::find($id)->delete();


        $data = [
            'message' => 'turnover deleted successfully',
            'status' => 'danger',
        ];
        $this->dispatch('notify', $data);

        $this->reset();
    }


    public function render()
    {
        $result = [] ?: ModelTurnover::all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = ModelTurnover::where('turnover_info', 'like', '%' . $search . '%')
                ->orwhere('turnover_product_name', 'like', '%' . $search . '%')
                ->orWhere('turnover_cost_of_goods_sold', 'like', '%' . $search . '%')
                ->orWhere('turnover_category', 'like', '%' . $search . '%')
                ->orWhere('turnover_inventory_turnover_ratio', 'like', '%' . $search . '%')
                ->orWhere('turnover_date', 'like', '%' . $search . '%')
                ->orWhere('turnover_department', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => PlanCategories::where('category_type', 'T8')->get(),
            'turnover' => $result,
        ];

        return view('livewire.admin.turnover', $data);
    }
}
