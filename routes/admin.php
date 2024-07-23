<?php

use App\Http\Controllers\BoardController;

use App\Http\Controllers\Fragments\Cycle\AddBdgtRqst;
use App\Http\Controllers\Fragments\Cycle\Allocate;
use App\Http\Controllers\Fragments\Cycle\Analytics;
use App\Http\Controllers\Fragments\Cycle\API\FinanceApproval;
use App\Http\Controllers\Fragments\Cycle\API\FinanceCost;
use App\Http\Controllers\Fragments\Cycle\API\FinancePayment;
use App\Http\Controllers\Fragments\Cycle\API\FinanceBudget;
use App\Http\Controllers\Fragments\Cycle\API\FinanceExpense;
use App\Http\Controllers\Fragments\Cycle\API\IncidentReport;
use App\Http\Controllers\Fragments\Cycle\BdgtRqst;
use App\Http\Controllers\Fragments\Cycle\BdgtTrack;
use App\Http\Controllers\Fragments\Cycle\Reporting;
use App\Http\Controllers\Fragments\Cycle\TravelExpense;
use App\Http\Controllers\Fragments\Cycle\TravelRqst;
use App\Http\Middleware\Auth\CheckRole as checkRole;
use App\Http\Controllers\Fragments\Cycle\API\ProjectMngmnt;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', checkRole::class . ':102'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', [BoardController::class, 'dashboard'])->name('admin');

        // New Plans
        Route::prefix('/new')->group(function () {
            Route::controller(AddBdgtRqst::class)->group(function () {
                Route::get('/addbudget', 'index')->name('admin.new.addbudget');
                Route::get('/addbudget/create/', 'create')->name('admin.new.addbudget.create');
                Route::post('/addbudget/create/save', 'store')->name('admin.new.addbudget.store');
                Route::get('/addbudget/{id}/edit', 'edit')->name('admin.new.addbudget.edit');
                Route::put('/addbudget/{id}/edit/update', 'update')->name('admin.new.addbudget.update');
                Route::put('/addbudget/{id}/edit/revise', 'revise')->name('admin.new.addbudget.revise');
                Route::post('/addbudget/{id}/delete', 'destroy')->name('admin.new.addbudget.delete');
                Route::get('/addbudget/search', 'search')->name('admin.new.addbudget.search');
            });

            Route::controller(BdgtRqst::class)->group(function () {
                Route::get('/budget', 'index')->name('admin.new.budget');
                Route::get('/budget/create/', 'create')->name('admin.new.budget.create');
                Route::post('/budget/create/save', 'store')->name('admin.new.budget.store');
                Route::get('/budget/{id}/edit', 'edit')->name('admin.new.budget.edit');
                Route::put('/budget/{id}/edit/update', 'update')->name('admin.new.budget.update');
                Route::put('/budget/{id}/edit/revise', 'revise')->name('admin.new.budget.revise');
                Route::post('/budget/{id}/delete', 'destroy')->name('admin.new.budget.delete');
                Route::get('/budget/search', 'search')->name('admin.new.budget.search');
            });

            Route::controller(BdgtTrack::class)->group(function () {
                Route::get('/bdgt/tracker', 'index')->name('admin.new.budgetPlan');
                Route::get('/bdgt/tracker/view-budget/{id}', 'create')->name('admin.new.budgetPlanExpenses');
                Route::post('/bdgt/tracker/save/{id}', 'saveBudgetExpense')->name('admin.new.saveBudgetExpense');
            });

            Route::controller(Reporting::class)->group(function () {
                Route::get('/reporting/{id}', 'index')->name('admin.new.reporting');
            });

            Route::controller(Allocate::class)->group(function () {
                Route::get('/allocation', 'index')->name('admin.new.allocation');
                Route::post('/allocation/create/save', 'store')->name('admin.new.allocation.store');
                Route::get('/allocation/{id}/view', 'viewAllocation')->name('admin.new.allocation.view');
            });

            Route::controller(TravelRqst::class)->group(function () {
                Route::get('travel-requests', 'index')->name('admin.new.travel');
                Route::get('travel-requests/view/{RequestID}', 'viewTravel')->name('admin.new.travel-view');
                Route::put('travel-requests/update/{RequestID}', 'update')->name('admin.new.travel-update');
                Route::put('travel-requests/revise/{RequestID}', 'revise')->name('admin.new.travel-revise');
                Route::get('travel-requests/search', 'search')->name('admin.new.travel-search');
            });

            Route::controller(TravelExpense::class)->group(function () {
                Route::get('travel-expenses', 'index')->name('admin.new.travel-expenses');
                Route::get('travel-expenses/breakdown/{RequestID}', 'view')->name('admin.new.travel-expenses-view');
            });

            Route::controller(Analytics::class)->group(function () {
                Route::get('analytics', 'index')->name('admin.new.analytics');
            });

            Route::controller(ProjectMngmnt::class)->group(function () {
                Route::get('project-management', 'index')->name('admin.new.project');
                Route::post('project-management/update/{id}', 'update')->name('admin.new.project.update');
                Route::get('project-management/search', 'search')->name('admin.new.project.search');
            });


            Route::controller(FinanceApproval::class)->group(function () {
                Route::get('/financial-approval-requests', 'index')->name('admin.new.finance.approvalRequests');
                Route::put('/financial-approval-requests/{id}', 'update')->name('admin.new.finance.approvalUpdate');
                Route::get('/financial-approval-requests/search', 'search')->name('admin.new.finance.approvalSearch');

            });

            Route::controller(FinanceCost::class)->group(function () {
                Route::get('/financial-cost-requests', 'index')->name('admin.new.finance.cost');
                Route::put('/financial-cost-requests/{id}', 'update')->name('admin.new.finance.costUpdate');
                Route::get('/financial-cost-requests/search', 'search')->name('admin.new.finance.costSearch');
            });

            Route::controller(FinanceBudget::class)->group(function () {
                Route::get('/financial-budget-requests', 'index')->name('admin.new.finance.budget');
                Route::put('/financial-budget-requests/{id}', 'update')->name('admin.new.finance.budgetUpdate');
                Route::get('/financial-budget-requests/search', 'search')->name('admin.new.finance.budgetSearch');
            });

            Route::controller(FinanceExpense::class)->group(function () {
                Route::get('/financial-expense-requests', 'index')->name('admin.new.finance.expense');
                Route::put('/financial-expense-requests/{id}', 'update')->name('admin.new.finance.expenseUpdate');
                Route::get('/financial-expense-requests/search', 'search')->name('admin.new.finance.expenseSearch');
            });

            Route::controller(FinancePayment::class)->group(function () {
                Route::get('/financial-payment-requests', 'index')->name('admin.new.finance.payment');
                Route::put('/financial-payment-requests/{id}', 'update')->name('admin.new.finance.paymentUpdate');
                Route::get('/financial-payment-requests/search', 'search')->name('admin.new.finance.paymentSearch');
            });

            Route::controller(IncidentReport::class)->group(function () {
                Route::get('/incident-report', 'index')->name('admin.new.incidentReport');
                Route::post('/incident-report/store', 'store')->name('admin.new.incident.store');
            });
        });
    });
});
