<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;

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

Route::get('/rewards', [RewardsController::class, 'apiIndex'])->name('api.rewards.index');

Route::get('/users', [UserController::class, 'apiIndex'])->name('api.users.index');

Route::post('/rewards', [RewardsController::class, 'store'])->name('reward.store');

Route::put('/users/{user}/removeFromTeam', [UserController::class, 'apiRemoveFromTeam'])->name('api.users.removeFromTeam');

Route::put('/users/{user}/addToTeam', [UserController::class, 'apiAddToTeam'])->name('api.users.addToTeam');

Route::get('teams', [TeamController::class, 'apiIndex'])->name('api.teams.index');
