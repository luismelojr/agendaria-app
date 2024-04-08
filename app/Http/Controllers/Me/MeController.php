<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Resources\AvailabilityResource;
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

    public function index($email)
    {
        $info = $this->service->getMe($email);

        return Inertia::render('Me/Index', [
            'user' => $info
        ]);
    }

    public function service($email, $service, Request $request)
    {
        $result = $this->service->getScheduleAndEmail($email, $service, $request);

        return Inertia::render('Me/Schedule', [
            'user' => $result['user'],
            'service' => $result['service'],
            'availability' => AvailabilityResource::collection($result['availability']),
            'date' => $result['date'],
            'calendar' => $request->calendar
        ]);

    }
}
