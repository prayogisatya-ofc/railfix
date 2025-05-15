<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::resource('', DashboardController::class)->names('dashboard');

Route::resource('location', LocationController::class)->except('show')->names('location');
    