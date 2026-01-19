<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SessionController;

Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::name("session.")->controller(SessionController::class)->group(function () { // prefix('admin') pievien zem vien url maršruta /admin/...
    Route::middleware("guest")->group(function () {
        Route::get("/login", "create")->name("create");
        Route::post("/login", "store")->name("store"); 
    });

    Route::post("/logout", "destroy")->name("destroy")->middleware("auth");
});
Route::name("user.")->middleware("guest")->controller(UserController::class)->group(function () {
    Route::get("/register", "create")->name("create");
    Route::post("/register", "store")->name("store");
});