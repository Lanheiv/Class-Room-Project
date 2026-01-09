<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SessionController;

Route::name("main.")->controller(MainController::class)->group(function () {
    if(auth()->user() == true) {
        Route::get("/", "authIndex")->middleware("auth")->name("authIndex");
    } else {
        Route::get("/", "guestIndex")->middleware("guest")->name("guestIndex");
    }
});

Route::name("session.")->controller(SessionController::class)->group(function () { // prefix('admin') pievien zem vien url maršruta /admin/...
    Route::middleware("guest")->group(function () {
        Route::get("/login", "create")->name("create");
        Route::post("/login", "store")->name("store"); 
    });

    Route::post("/logut", "destroy")->name("destroy")->middleware("auth");
});
Route::name("user.")->middleware("guest")->controller(UserController::class)->group(function () {
    Route::get("/register", "create")->name("create");
    Route::post("/register", "store")->name("store");
});