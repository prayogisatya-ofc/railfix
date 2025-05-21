<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

Route::resource('', DashboardController::class)->names('dashboard');

Route::resource('locations', LocationController::class)->except('show')->names('location');

Route::resource('inventories', InventoryController::class)->except('show')->names('inventories');

Route::get('inventories/print', [InventoryController::class, 'print'])->name('inventories.print');

Route::resource('admin', AdminController::class)->except('show')->names('admin');
