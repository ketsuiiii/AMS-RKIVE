<?php

use App\Http\Controllers\BoardController;

use App\Http\Controllers\Fragments\Cycle\AddBdgtRqst;
use App\Http\Controllers\Fragments\Cycle\Allocate;
use App\Http\Controllers\Fragments\Cycle\Analytics;
use App\Http\Controllers\Fragments\Cycle\API\FinanceApproval;
use App\Http\Controllers\Fragments\Cycle\API\IncidentReport;
use App\Http\Controllers\Fragments\Cycle\BdgtRqst;
use App\Http\Controllers\Fragments\Cycle\BdgtTrack;
use App\Http\Controllers\Fragments\Cycle\Reporting;
use App\Http\Controllers\Fragments\Cycle\TravelExpense;
use App\Http\Controllers\Fragments\Cycle\TravelRqst;
use App\Http\Middleware\Auth\CheckRole as checkRole;
use App\Http\Controllers\Fragments\Cycle\API\ProjectMngmnt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fragments\Cycle\API\FinancialController;

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
|
| Here is where you can register employee routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', checkRole::class . ':103'])->group(function () {
    Route::prefix('/employee')->group(function () {
        Route::get('/dashboard', [BoardController::class, 'dashboard'])->name('employee');

        // New Plans
        Route::prefix('/new')->group(function () {
            Route::controller(AddBdgtRqst::class)->group(function () {
                Route::get('/addbudget', 'index')->name('employee.new.addbudget');
                Route::get('/addbudget/create/', 'create')->name('employee.new.addbudget.create');
                Route::post('/addbudget/create/save', 'store')->name('employee.new.addbudget.store');
                Route::get('/addbudget/{id}/edit', 'edit')->name('employee.new.addbudget.edit');
                Route::put('/addbudget/{id}/edit/update', 'update')->name('employee.new.addbudget.update');
                Route::put('/addbudget/{id}/edit/revise', 'revise')->name('employee.new.addbudget.revise');
                Route::post('/addbudget/{id}/delete', 'destroy')->name('employee.new.addbudget.delete');
                Route::get('/addbudget/search', 'search')->name('employee.new.addbudget.search');
            });

            Route::controller(BdgtRqst::class)->group(function () {
                Route::get('/budget', 'index')->name('employee.new.budget');
                Route::get('/budget/create/', 'create')->name('employee.new.budget.create');
                Route::post('/budget/create/save', 'store')->name('employee.new.budget.store');
                Route::get('/budget/{id}/edit', 'edit')->name('employee.new.budget.edit');
                Route::put('/budget/{id}/edit/update', 'update')->name('employee.new.budget.update');
                Route::put('/budget/{id}/edit/revise', 'revise')->name('employee.new.budget.revise');
                Route::post('/budget/{id}/delete', 'destroy')->name('employee.new.budget.delete');
                Route::get('/budget/search', 'search')->name('employee.new.budget.search');
            });

            Route::controller(BdgtTrack::class)->group(function () {
                Route::get('/bdgt/tracker', 'index')->name('employee.new.budgetPlan');
                Route::get('/bdgt/tracker/view-budget/{id}', 'create')->name('employee.new.budgetPlanExpenses');
                Route::post('/bdgt/tracker/save/{id}', 'saveBudgetExpense')->name('employee.new.saveBudgetExpense');
            });

            Route::controller(Reporting::class)->group(function () {
                Route::get('/reporting/{id}', 'index')->name('employee.new.reporting');
            });

            Route::controller(Allocate::class)->group(function () {
                Route::get('/allocation', 'index')->name('employee.new.allocation');
                Route::post('/allocation/create/save', 'store')->name('employee.new.allocation.store');
                Route::get('/allocation/{id}/view', 'viewAllocation')->name('employee.new.allocation.view');
            });

            Route::controller(TravelRqst::class)->group(function () {
                Route::get('travel-requests', 'index')->name('employee.new.travel');
                Route::get('travel-requests/view/{RequestID}', 'viewTravel')->name('employee.new.travel-view');
                Route::put('travel-requests/update/{RequestID}', 'update')->name('employee.new.travel-update');
                Route::put('travel-requests/revise/{RequestID}', 'revise')->name('employee.new.travel-revise');
                Route::get('travel-requests/search', 'search')->name('employee.new.travel-search');
            });

            Route::controller(TravelExpense::class)->group(function () {
                Route::get('travel-expenses', 'index')->name('employee.new.travel-expenses');
                Route::get('travel-expenses/breakdown/{RequestID}', 'view')->name('employee.new.travel-expenses-view');
            });

            Route::controller(Analytics::class)->group(function () {
                Route::get('analytics', 'index')->name('employee.new.analytics');
            });

            Route::controller(ProjectMngmnt::class)->group(function () {
                Route::get('project-management', 'index')->name('employee.new.project');
                Route::post('project-management/update/{id}', 'update')->name('employee.new.project.update');
                Route::get('project-management/search', 'search')->name('employee.new.project.search');
            });

            Route::controller(FinancialController::class)->group(function () {
                Route::get('/financial-budget', 'budget')->name('employee.new.finance.budget');
                Route::put('/financial-budget/{id}', 'budgetUpdate')->name('employee.new.finance.budgetUpdate');

                Route::get('/financial-cost', 'cost')->name('employee.new.finance.cost');
                Route::put('/financial-cost/{id}', 'costUpdate')->name('employee.new.finance.costUpdate');

                Route::get('/financial-expenes', 'expense')->name('employee.new.finance.expense');
                Route::put('/financial-expenes/{id}', 'expenseUpdate')->name('employee.new.finance.expenseUpdate');

                Route::get('/financial-payment', 'payment')->name('employee.new.finance.payment');
                Route::put('/financial-payment/{id}', 'paymentUpdate')->name('employee.new.finance.paymentUpdate');

                Route::get('/financial-pull-requests', 'pullRequests')->name('employee.new.finance.pullRequests');

            });

            Route::controller(FinanceApproval::class)->group(function () {
                Route::get('/financial-approval-requests', 'index')->name('employee.new.finance.approvalRequests');
                Route::put('/financial-approval-requests/{id}', 'update')->name('employee.new.finance.approvalUpdate');
                Route::get('/financial-approval-requests/search', 'search')->name('employee.new.finance.approvalSearch');

            });

            Route::controller(IncidentReport::class)->group(function () {
                Route::get('/incident-report', 'index')->name('employee.new.incidentReport');
                Route::post('/incident-report/store', 'store')->name('employee.new.incident.store');
            });
        });
    });
});
