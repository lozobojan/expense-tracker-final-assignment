<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
    }
}
