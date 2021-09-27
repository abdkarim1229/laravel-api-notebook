<?php

use App\Http\Controllers\NotebookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('notebooks', NotebookController::class);
Route::apiResource('users', UserController::class);
