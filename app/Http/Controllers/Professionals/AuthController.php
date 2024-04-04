<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professionals\RegisterRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function loginPage()
    {

    }

    public function registerPage()
    {
        return Inertia::render('Professionals/Auth/Register');
    }

    public function register(RegisterRequest $request)
    {
        dd($request->validated());
    }
}
