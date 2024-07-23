<?php


use App\Http\Controllers\Fragments\Cycle\API\IntegrationController;
use App\Http\Controllers\Fragments\Cycle\API\UserManagement;
use App\Http\Controllers\Fragments\DepartmentController;
use App\Http\Controllers\Fragments\RoleController;
use App\Http\Controllers\Fragments\UserController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;

use App\Http\Middleware\Auth\CheckRole as checkRole;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('index');
})->name('/');

Route::view('index', 'index')->name('index');

// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('/rkive-financials/public/livewire/update', $handle);
// });

// Livewire::setScriptRoute(function ($handle) {
//     return Route::get('/rkive-financials/public/livewire/livewire.js', $handle);
// });

Route::prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/verification', [AuthController::class, 'loginPost'])->name('loginPost');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/log-out', [AuthController::class, 'logout']);

    Route::get('/force-logout', function () {
        auth()->logout();
        return redirect()->route('login')->with('success', 'You have been successfully logged out.');
    })->name('developer');

    Route::get('/clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        return redirect()->route('login')->with('success', 'Cache and Route has been cleared.');
    })->name('clear');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register/verification', [AuthController::class, 'registerPost'])->name('registerPost');

    Route::get('/forgot-password', [AuthController::class, 'resetForm'])->name('resetForm');
    Route::post('/forgot-password/verification', [AuthController::class, 'resetPost'])->name('resetPost');

    Route::get('/g53-register', [UserManagement::class, 'userForm'])->name('g53Register');
    Route::post('/g53-register/verification', [UserManagement::class, 'registerPost'])->name('g53RegisterPost');

    Route::get('/block', [AuthController::class, 'block'])->name('block');
    Route::post('/block/back', [AuthController::class, 'blockPost'])->name('blockPost');

    Route::get('/extend-session', [AuthController::class, 'extendSession'])->name('extendSession');
    Route::post('/extend-session/back', [AuthController::class, 'extendSessionPost'])->name('extendSessionPost');
});

Route::prefix('/company')->group(function () {
    Route::get('/role/create', [RoleController::class, 'roleForm'])->name('roleForm');
    Route::post('/role/save', [RoleController::class, 'rolePost'])->name('rolePost');

    Route::get('/department/create', [DepartmentController::class, 'deptForm'])->name('deptForm');
    Route::post('/department/save', [DepartmentController::class, 'deptPost'])->name('deptPost');

    Route::get('/employee/create', [UserController::class, 'userForm'])->name('userForm');
    Route::post('/employee/save', [UserController::class, 'userPost'])->name('userPost');
});

Route::prefix('/terms')->group(function () {
    Route::get('/policy', [BoardController::class, 'policy'])->name('policy');
    Route::get('/punishment', [BoardController::class, 'punishment'])->name('punishment');
    Route::get('/responsibility', [BoardController::class, 'responsibility'])->name('responsibility');
});

Route::prefix('/account')->group(function () {
    Route::get('/view', [UserController::class, 'view'])->name('account.view');
    Route::post('{id}/update/profile', [UserController::class, 'updateProfile'])->name('updateProfile');
});

// Connections
Route::get('/helpdesk', [BoardController::class, 'helpdesk'])->name('helpdesk');
Route::get('/calendar', [BoardController::class, 'calendar'])->name('calendar');
Route::get('/logs', [BoardController::class, 'logs'])->name('logs');

// Superadmin
Route::get('superadmin/login', [AuthController::class, 'superAdmin'])->name('superadmin.login');
Route::get('tutorial/users', [IntegrationController::class, 'USR'])->name('USR');

//Email Response
Route::get('email/response', [IntegrationController::class, 'mailResponse'])->name('email.response');

Route::get('integration/track', [IntegrationController::class, 'track'])->name('integration.track');
Route::get('integration/search', [IntegrationController::class, 'search'])->name('integration.search');
