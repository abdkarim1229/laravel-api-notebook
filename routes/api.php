<?php

use App\Http\Controllers\NotebookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('notebooks', NotebookController::class);