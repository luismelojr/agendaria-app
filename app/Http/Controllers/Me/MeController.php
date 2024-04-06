<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Services\Me\MeService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MeController extends Controller
{
    public function __construct(
        private MeService $service
    )
    {
    }

    public function __invoke($email)
    {
        $info = $this->service->getMe($email);

        return Inertia::render('Me/Index', [
            'user' => $info
        ]);
    }
}
