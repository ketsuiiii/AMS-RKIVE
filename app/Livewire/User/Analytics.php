<?php

namespace App\Livewire\User;

use App\Models\Old\AddBudgets;
use App\Models\Old\Balance;
use App\Models\Old\Budget;
use App\Models\Old\Cashflow;
use App\Models\Old\Income;
use App\Models\Old\Payable;
use App\Models\Old\Recievable;
use App\Models\Old\Sales;
use App\Models\Old\Turnover;
use Livewire\Component;

class Analytics extends Component

{
    public function render()
    {
        $budgets = Budget::all();
        $addbudgets = AddBudgets::all();
        $cashflow = Cashflow::all();
        $balance = Balance::all();
        $income = Income::all();
        $payable = Payable::all();
        $recievable = Recievable::all();
        $sales = Sales::all();
        $turnover = Turnover::all();

        $data = [
            'budgetData' => $budgets,
            'addBudgetData' => $addbudgets,
            'cashflowData' => $cashflow,
            'balanceData' => $balance,
            'incomeData' => $income,
            'payableData' => $payable,
            'recievableData' => $recievable,
            'salesData' => $sales,
            'turnoverData' => $turnover
        ];

        return view('livewire.user.analytics', $data);
    }
}
