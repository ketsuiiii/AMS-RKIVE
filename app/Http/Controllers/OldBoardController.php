<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OldBoardController extends Controller
{
    public function budget()
    {
        return view('board.old.budget');
    }

    public function addbudget()
    {
        return view('board.old.addbudget');
    }

    public function cashflow()
    {
        return view('board.old.cashflow');
    }

    public function balance()
    {
        return view('board.old.balance');
    }

    public function income()
    {
        return view('board.old.income');
    }

    public function recievable()
    {
        return view('board.old.recievable');
    }
    public function payable()
    {
        return view('board.old.payable');
    }

    public function turnover()
    {
        return view('board.old.turnover');
    }

    public function sales()
    {
        return view('board.old.sales');
    }

    public function analytics()
    {
        return view('board.old.analytics');
    }

    public function report()
    {
        return view('board.old.reporting');
    }
}
