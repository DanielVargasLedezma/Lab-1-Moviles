<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateTempPassword extends Controller
{
    //

    public static function generatePasswordTemp($request)
    {
        $chars = str_shuffle('!$%^*&!$%^&abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ1234567890');

        $chars = substr(($chars), 0, 13);

        $chars = str_shuffle($chars . $request->input('nombre'));

        return substr(($chars), 0, 13);
    }
}
