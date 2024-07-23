<?php

namespace App\Livewire\User;

use Livewire\Component;

use App\Models\Old\Budget;
use App\Models\Old\AddBudgets;
use App\Models\Categories;
use App\Models\Department;
use App\Models\Status;
use App\Models\User;

class Dashboard extends Component
{
    public $user;
    public function mount($user = null)
    {
        $this->user = $user;
    }
    public function render()
    {
        $budgets = Budget::all();
        $budgetsRequest = AddBudgets::all();

        $data = [
            'groupedBudgets' => $budgets->groupBy('budget_department'),
            'groupedBudgetRequests' => $budgetsRequest->groupBy('request_department'),
            'departments' => Department::all(),
            'status' => Status::all(),
            'categories' => Categories::all(),
            'users' => User::all(),
        ];

        return view('livewire.user.dashboard', $data);
    }
}
