<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professionals\RegisterRequest;
use App\Services\Professionals\AuthService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $service
    ){}

    public function loginPage()
    {
        return Inertia::render('Professionals/Auth/Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        dd($request->all());
    }

    public function registerPage(Request $request)
    {
        $plan = $request->plan ? $request->plan == 'premium' ? 'premium' : 'basic' : 'basic';
        return Inertia::render('Professionals/Auth/Register', [
            'plan' => $plan,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->service->register($request->all());
        return redirect()->route('professionals.login.show')->toast('Conta criada com sucesso! Faça login para continuar.');
    }
}
