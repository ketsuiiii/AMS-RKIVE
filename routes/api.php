<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Fragments\Cycle\API\IntegrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fragments\Cycle\API\RkiveController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('approved-budget', [RkiveController::class, 'budgetApproved']);
Route::get('approved-encrypted-budget', [RkiveController::class, 'budgetEncrypt']);
Route::get('approved-decrypted-budget', [RkiveController::class, 'budgetDecrypt']);


// SuperAdmin
Route::post('superadmin/login', [AuthController::class, 'superAdmin'])->name('superadmin.login');

// New Plans
Route::prefix('/integration')->group(function () {
    Route::controller(IntegrationController::class)->group(function () {
        Route::get('/addbudget', 'ABR');
        Route::post('/addbudget', 'ABRP');
    });

    Route::controller(IntegrationController::class)->group(function () {
        Route::get('/budget', 'BR')->name('BR');
        Route::post('/budget', 'BRP')->name('BRP');
    });
});
