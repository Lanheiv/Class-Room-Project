<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . "web/index.php";


Route::get('/', function () {
    return view('index');
});
