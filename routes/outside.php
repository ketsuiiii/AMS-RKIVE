<?php

use App\Http\Controllers\OldBoardController;
use App\Http\Middleware\Auth\CheckRole as checkRole;
use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Old Routes
|--------------------------------------------------------------------------
|
| Here is where you can register old routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Old Plans
Route::middleware(['auth', checkRole::class . ':102'])->group(function () {

    Route::group(['prefix' => '/admin'], function () {

        // Plans
        Route::get('/budget', [OldBoardController::class, 'budget'])->name('admin.old.budgets');
        Route::get('/addrequest', [OldBoardController::class, 'addbudget'])->name('admin.old.addbudgets');
        Route::get('/cashflow', [OldBoardController::class, 'cashflow'])->name('admin.old.cashflow');
        Route::get('/balance', [OldBoardController::class, 'balance'])->name('admin.old.balance');
        Route::get('/income', [OldBoardController::class, 'income'])->name('admin.old.income');
        Route::get('/recievable', [OldBoardController::class, 'recievable'])->name('admin.old.recievable');
        Route::get('/payable', [OldBoardController::class, 'payable'])->name('admin.old.payable');
        Route::get('/turnover', [OldBoardController::class, 'turnover'])->name('admin.old.turnover');
        Route::get('/sales', [OldBoardController::class, 'sales'])->name('admin.old.sales');

        // Analytics
        Route::get('/analytics', [OldBoardController::class, 'analytics'])->name('admin.old.analytics');

        // Reporting
        Route::get('/reporting', [OldBoardController::class, 'report'])->name('admin.old.report');
    });
});


Route::middleware(['auth', checkRole::class . ':103'])->group(function () {

    Route::group(['prefix' => '/employee'], function () {

        // Plans
        Route::get('/budget', [OldBoardController::class, 'budget'])->name('employee.old.budgets');
        Route::get('/addrequest', [OldBoardController::class, 'addbudget'])->name('employee.old.addbudgets');
        Route::get('/cashflow', [OldBoardController::class, 'cashflow'])->name('employee.old.cashflow');
        Route::get('/balance', [OldBoardController::class, 'balance'])->name('employee.old.balance');
        Route::get('/income', [OldBoardController::class, 'income'])->name('employee.old.income');
        Route::get('/recievable', [OldBoardController::class, 'recievable'])->name('employee.old.recievable');
        Route::get('/payable', [OldBoardController::class, 'payable'])->name('employee.old.payable');
        Route::get('/turnover', [OldBoardController::class, 'turnover'])->name('employee.old.turnover');
        Route::get('/sales', [OldBoardController::class, 'sales'])->name('employee.old.sales');

        // Analytics
        Route::get('/analytics', [OldBoardController::class, 'analytics'])->name('employee.old.analytics');

        // Reporting
        Route::get('/reporting', [OldBoardController::class, 'report'])->name('employee.old.report');
    });
});
