<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;

use App\Http\Controllers\SessionController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [SessionController::class, "create"])->name("login");

Route::post('/', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);


Route::get('/register', [RegisterController::class, "create"])->middleware("guest");

Route::post('/register', [RegisterController::class, 'store']);