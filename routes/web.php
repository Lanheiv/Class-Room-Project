<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ClassController;

Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::name("session.")->controller(SessionController::class)->group(function () { // prefix('admin') pievien zem vien url maršruta /admin/...
    Route::middleware("guest")->group(function () {
        Route::get("/login", "create")->name("create");
        Route::post("/login", "store")->name("store"); 
    });

    Route::post("/logout", "destroy")->name("destroy")->middleware("auth");
});
Route::name("user.")->middleware("guest")->controller(UserController::class)->group(function () {
    Route::middleware("guest")->group(function () {
        Route::get("/register", "create")->name("create");
        Route::post("/register", "store")->name("store");
    });

    Route::get("/profile", "index")->name("index")->middleware("auth");
});
Route::name("class.")->middleware("auth")->controller(ClassController::class)->group(function () {
    Route::get("/class/{id}", "index")->name("index");
    
    Route::get("/create-class", "create")->name("create");
    Route::post("/create-class", "store")->name("store");

    Route::get("/join-class", "join")->name("join");
    Route::post("/join-class", "store_join")->name("store_join");
});