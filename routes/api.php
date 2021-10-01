<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('notebooks', NotebookController::class);
Route::apiResource('users', UserController::class);
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});
