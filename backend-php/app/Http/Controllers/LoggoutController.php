<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoggoutController extends Controller
{
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Session cerrada'
        ], 200);
    }
}
