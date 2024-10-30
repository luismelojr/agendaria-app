<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Professionals\ServiceService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HoursExclusionController extends Controller
{
    public function __construct(
        private readonly ServiceService $service
    ){}

    public function index(Request $request)
    {
        $filters = $request->query('filters') ? explode(',', $request->query('filters')) : [];
        $sorts = $request->query('sorts') ? explode(',', $request->query('sorts')) : [];

        return Inertia::render('Professionals/Hours/Exclusions/Index', [
            'exclusions' => $this->service->findFilterAll($filters, $sorts, $request->perPage),
            'filters' => $filters,
            'sorts' => $sorts,
        ]);
    }
}
