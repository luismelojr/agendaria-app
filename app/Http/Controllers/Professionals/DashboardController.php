<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return Inertia::render('Professionals/Dashboard/Index', [
            'serviceCount' => $user->services->count(),
            'appointmentTotalCount' => $user->appointments->count(),
            'appointmentTodayCount' => $user->appointments->where('date', now()->format('Y-m-d'))->count(),
        ]);
    }
}
