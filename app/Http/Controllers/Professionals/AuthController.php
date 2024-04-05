<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Professionals\RegisterRequest;
use App\Models\User;
use App\Services\Professionals\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
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
        $plan = $request->plan ? $request->plan == 'premium' ? 'premium' : 'basic' : 'basic';
        /** @var User $user */
        $user = $this->service->register($request->all());
        $user->createOrGetStripeCustomer();

        if ($plan == 'premium') {
            return Inertia::location($user->newSubscription('default', config('productstripe.price_id'))
                ->checkout()
                ->redirect());
        }


        return redirect()->route('login')->toast('Conta criada com sucesso! Faça login para continuar.');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
