<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Client\ClaimController as ClientClaimController;
use App\Http\Controllers\Manager\ClaimController as ManagerClaimController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AccordionPageController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::post('/user_register', [AuthController::class, 'store'])->name('user_register');

Route::prefix('manager')->name('manager.')->middleware(['auth:sanctum', 'verified', 'CheckIsManager' ])->group(function() {
    Route::get('new_claims/index', [ManagerClaimController::class, 'new_claims'])->name('new_claims.index');
    Route::get('new_claims/load', [ManagerClaimController::class, 'load_new_claims'])->name('new_claims.load');

    Route::delete('new_claims/{claim_id}', [ManagerClaimController::class, 'destroy'])->name('new_claims.destroy');
    Route::put('new_claims/{claim_id}', [ManagerClaimController::class, 'answer'])->name('new_claims.answer');


    Route::get('accordion_page', [AccordionPageController::class, 'index'])->name('accordion.index');
    Route::get('load_active_cms_items', [AccordionPageController::class, 'load_active_cms_items'])->name('accordion.load_active_cms_items');

});

Route::prefix('client')->name('client.')->middleware(['auth:sanctum', 'verified', 'CheckIsClient' ])->group(function() {
    Route::get('claim_create_form', [ClientClaimController::class, 'create'])->name('claim.create');
    Route::post('claims', [ ClientClaimController::class, 'store'] )->name('claims.store');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
