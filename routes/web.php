<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\SupervisorDashboardController;
use App\Http\Controllers\AdminController;

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

Route::redirect('/', '/login');

Route::get('/agentdashboard',[AgentDashboardController::class,'show'])->middleware(['auth','ensureuserisagent'])->name('agentdashboard.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::put('reward/redeem/{reward}',[RewardsController::class,'redeem'])->middleware(['auth','ensureuserisagent','verifyrewardredeem'])->name('reward.redeem');

require __DIR__.'/auth.php';

Route::get('/supervisordashboard', [SupervisorDashboardController::class, 'show'])
        ->middleware(['auth', 'supervisor'])
        ->name('supervisordashboard.show');


Route::get('admin', [AdminController::class, 'index'])->name('admin.index')->middleware(['auth','ensureuserisadmin']);

Route::get('admin/showWebAgents', [AdminController::class, 'showWebAgents'])->name('admin.showWebAgents')->middleware(['auth','ensureuserisadmin']);

Route::get('admin/showWebAgents/create', [AdminController::class, 'createWebAgent'])->name('admin.createWebAgent')->middleware(['auth','ensureuserisadmin']);

Route::post('admin/showWebAgents', [AdminController::class, 'storeWebAgent'])->name('admin.storeWebAgent')->middleware(['auth','ensureuserisadmin']);

Route::get('admin/showWebAgents/{user}', [AdminController::class, 'webAgentDetails'])->name('admin.webAgentDetails')->middleware(['auth','ensureuserisadmin']);

Route::delete('admin/showWebAgents/{user}', [AdminController::class, 'destroyWebAgent'])->name('admin.destroyWebAgent')->middleware(['auth','ensureuserisadmin']);

Route::get('admin/showWebAgents/{user}/edit', [AdminController::class, 'editWebAgent'])->name('admin.editWebAgent')->middleware(['auth','ensureuserisadmin']);

Route::post('admin/showWebAgents/{user}', [AdminController::class, 'updateWebAgent'])->name('admin.updateWebAgent')->middleware(['auth','ensureuserisadmin']);


Route::get('admin/showSupervisors', [AdminController::class, 'showSupervisors'])->name('admin.showSupervisors')->middleware(['auth','ensureuserisadmin']);

Route::get('admin/showSupervisors/create', [AdminController::class, 'createSupervisor'])->name('admin.createSupervisor')->middleware(['auth','ensureuserisadmin']);

Route::post('admin/showSupervisors', [AdminController::class, 'storeSupervisor'])->name('admin.storeSupervisor')->middleware(['auth','ensureuserisadmin']);

Route::get('admin/showSupervisors/{user}', [AdminController::class, 'supervisorDetails'])->name('admin.supervisorDetails')->middleware(['auth','ensureuserisadmin']);

Route::delete('admin/showSupervisors/{user}', [AdminController::class, 'destroySupervisor'])->name('admin.destroySupervisor')->middleware(['auth','ensureuserisadmin']);

Route::get('admin/showSupervisors/{user}/edit', [AdminController::class, 'editSupervisor'])->name('admin.editSupervisor')->middleware(['auth','ensureuserisadmin']);

Route::post('admin/showSupervisors/{user}', [AdminController::class, 'updateSupervisor'])->name('admin.updateSupervisor')->middleware(['auth','ensureuserisadmin']);
