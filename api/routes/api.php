<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarshipController;
use App\Http\Controllers\VehicleController;

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

Route::prefix('/starships')->group(function(){
  Route::get('/', [StarshipController::class, 'index']);
  Route::get('/{starshipId}', [StarshipController::class, 'show']);
  Route::middleware(['checkIfExistResource'])->post('/{starshipId}/increase-counter', [StarshipController::class, 'increaseCounter']);
  Route::middleware(['checkIfExistResource'])->post('/{starshipId}/decrease-counter', [StarshipController::class, 'decreaseCounter']);
  Route::middleware(['checkIfExistResource'])->post('/{starshipId}/set-counter', [StarshipController::class, 'setCounter']);
});

Route::prefix('/vehicles')->group(function(){
  Route::get('/', [VehicleController::class, 'index']);
  Route::get('/{id}', [VehicleController::class, 'show']);
  Route::middleware(['checkIfExistResource'])->post('/{vehicleId}/set-counter', [VehicleController::class, 'setCounter']);
  Route::middleware(['checkIfExistResource'])->post('/{vehicleId}/increase-counter', [VehicleController::class, 'increaseCounter']);
  Route::middleware(['checkIfExistResource'])->post('/{vehicleId}/decrease-counter', [VehicleController::class, 'decreaseCounter']);
});