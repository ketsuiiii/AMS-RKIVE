<?php

namespace App\Livewire\Admin;

use App\Models\Department;
use App\Models\PlanCategories;
use App\Models\Old\Sales as ModelsSales;

use Livewire\Component;

class Sales extends Component
{
    public $sales_info;
    public $sales_product_name;
    public $sales_department;
    public $sales_revenue;
    public $sales_category;
    public $sales_date;
    public $terms;

    public $isOpen = 1;
    public $salesId;
    public $search;

    public $dept;

    protected $rules = [
        'sales_info' => 'required',
        'sales_product_name' => 'required',
        'sales_department' => 'required',
        'sales_revenue' => 'required',
        'sales_category' => 'required',
        'sales_date' => 'required',

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
        ModelsSales::create([
            'sales_product_name' => $this->sales_product_name,
            'sales_department' => $this->sales_department,
            'sales_revenue' => $this->sales_revenue,
            'sales_category' => $this->sales_category,
            'sales_date' => date('Y-m-d', strtotime($this->sales_date)),
            'sales_info' => $this->sales_info,

            'sales_type' => 'T9',
        ]);

        $this->dispatch('notify', [
            'status' => 'success',
            'message' => 'Sales created successfully',
        ]);

        $this->openModal();

        $this->reset();
    }

    public function edit($id)
    {
        $sales = ModelsSales::findOrFail($id);
        $this->salesId = $id;
        $this->sales_info = $sales->sales_info;
        $this->sales_product_name = $sales->sales_product_name;
        $this->sales_department = $sales->sales_department;
        $this->sales_revenue = $sales->sales_revenue;
        $this->sales_category = $sales->sales_category;
        $this->sales_date = $sales->sales_date;

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        if ($this->salesId) {
            $sales = ModelsSales::findOrFail($this->salesId);
            $sales->update([
                'sales_info' => $this->sales_info,
                'sales_department' => $this->sales_department,
                'sales_revenue' => $this->sales_revenue,
                'sales_category' => $this->sales_category,
                'sales_date' => date('Y-m-d', strtotime($this->sales_date)),
                'sales_product_name' => $this->sales_product_name,
            ]);


            $this->dispatch('notify', [
                'status' => 'warning',
                'message' => 'Sales updated successfully',
            ]);


            $this->openModal();

            $this->reset();
        }
    }

    public function delete($id)
    {
        ModelsSales::find($id)->delete();


        $data = [
            'message' => 'Sales deleted successfully',
            'status' => 'danger',
        ];
        $this->dispatch('notify', $data);

        $this->reset();
    }


    public function render()
    {
        $result = [] ?: ModelsSales::all();
        $search = $this->search;

        if (strlen($search) > 0) {
            $result = ModelsSales::where('sales_info', 'like', '%' . $search . '%')
                ->orwhere('sales_product_name', 'like', '%' . $search . '%')
                ->orWhere('sales_revenue', 'like', '%' . $search . '%')
                ->orWhere('sales_category', 'like', '%' . $search . '%')
                ->orWhere('sales_date', 'like', '%' . $search . '%')
                ->orWhere('sales_department', 'like', '%' . $search . '%')
                ->get();
        }

        $data = [
            'departments' => Department::all(),
            'categories' => PlanCategories::where('category_type', 'T9')->get(),
            'sales' => $result,
        ];

        return view('livewire.admin.sales', $data);
    }

}
