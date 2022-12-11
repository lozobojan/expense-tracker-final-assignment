<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CurrentUserController extends Controller
{
    public function __invoke(Request $request)
    {
        return auth()->user();
    }
}
