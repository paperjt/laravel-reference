<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::apiResource('blogs', BlogController::class)->except(['store']);
