<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\VendorController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('events', EventController::class);
   
    Route::apiResource('tasks', TaskController::class);
    Route::get('events/{event_id}/tasks', [TaskController::class, 'getTasksByEvent']);

    Route::apiResource('guests', GuestController::class);
    Route::get('events/{event_id}/guests', [GuestController::class, 'getGuestsByEvent']);


    Route::apiResource('vendors', VendorController::class);
    Route::get('events/{event_id}/vendors', [VendorController::class, 'getVendorsByEvent']);
});
