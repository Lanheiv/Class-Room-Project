<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubmissionController;


Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::name("session.")->controller(SessionController::class)->group(function () { // prefix('admin') pievien zem vien url maršruta /admin/...
    Route::middleware("guest")->group(function () {
        Route::get("/login", "create")->name("create");
        Route::post("/login", "store")->name("store"); 
    });

    Route::post("/logout", "destroy")->name("destroy")->middleware("auth");
});
Route::name("user.")->controller(UserController::class)->group(function () {
    Route::middleware("guest")->group(function () {
        Route::get("/register", "create")->name("create");
        Route::post("/register", "store")->name("store");
    });

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('user.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user.edit');
        Route::post('/profile/edit', [ProfileController::class, 'update'])->name('user.update');
    });
});
Route::name("class.")->middleware("auth")->controller(ClassController::class)->group(function () {
    Route::get("/class/{id}", "index")->name("index");
    
    Route::get("/create-class", "create")->name("create");
    Route::post("/create-class", "store")->name("store");

    Route::get("/join-class", "join")->name("join");
    Route::post("/join-class", "store_join")->name("store_join");
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/user/{user}', [AdminController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{user}', [AdminController::class, 'update'])->name('admin.user.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/classes/{class}/tasks', [TaskController::class, 'store'])->name('task.store');
    Route::post('/tasks/{task}/submit', [SubmissionController::class, 'store'])->name('submission.store');
    Route::post('/submissions/{submission}/grade', [SubmissionController::class, 'grade'])->name('submission.grade');
});