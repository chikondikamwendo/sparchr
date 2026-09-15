<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LogoutController
{
    public function __invoke(Request $request)
    {
        Auth::guard('api')->logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return Response::json(null, 204);
    }
}
