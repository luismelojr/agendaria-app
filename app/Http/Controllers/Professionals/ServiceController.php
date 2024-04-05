<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $services = auth()->user()->services()->paginate(3);

        return Inertia::render('Professionals/Services/Index', [
            'services' => $services
        ]);
    }
}
