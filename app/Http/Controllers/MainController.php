<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function guestIndex() {
        return view("website.main.gest_index");
    }
    public function authIndex() {
        return view("website.main.auth_index");
    }
}
