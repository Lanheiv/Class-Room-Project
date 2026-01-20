<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;
use App\Models\Logs;

class LogActivity
{
    public static function add($action, $tabel)
    {
        if (!auth()->check()) {
            return;
        }

        Logs::create([
            'user_id' => auth()->id(),
            'action'  => $action,
            'tabel'    => $tabel,
            'ip'      => Request::ip(),
        ]);
    }

    public static function all()
    {
        return Logs::latest()->get();
    }
}
