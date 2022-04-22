<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\SupervisorDashboardController;

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
    return view('welcome');
});

Route::get('/agentdashboard',[AgentDashboardController::class,'show'])->middleware(['auth','ensureuserisagent'])->name('agentdashboard.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::put('reward/redeem/{reward}',[RewardsController::class,'redeem'])->middleware(['auth','ensureuserisagent','verifyrewardredeem'])->name('reward.redeem');

require __DIR__.'/auth.php';

Route::get('/supervisordashboard', [SupervisorDashboardController::class, 'show'])
        ->middleware(['auth', 'supervisor'])
        ->name('supervisordashboard.show');
