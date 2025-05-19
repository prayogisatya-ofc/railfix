<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

Route::resource('', DashboardController::class)->names('dashboard');

Route::resource('locations', LocationController::class)->except('show')->names('location');

Route::resource('inventories', InventoryController::class)->except('show')->names('inventory');
Route::get('inventories/print', [InventoryController::class, 'print'])->name('inventory.print');
