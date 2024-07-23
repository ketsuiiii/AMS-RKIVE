<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BoardController extends Controller
{
    public function dashboard()
    {
        return view('board.dashboard');
    }

    public function policy()
    {
        return view('board.policy');
    }

    public function punishment()
    {
        return view('board.punishment');
    }

    public function responsibility()
    {
        return view('board.responsibility');
    }
    public function helpdesk()
    {
        // return redirect()->away('https://helpdesk.rkiveadmin.com/ticket-form');
        return view('board.new.helpdesk');
    }

    public function calendar()
    {
        return view('board.new.calendar');
    }

    public function logs()
    {
        return view('board.new.logs');
    }
}
