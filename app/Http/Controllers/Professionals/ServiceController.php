<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professionals\ServiceRequest;
use App\Models\Service;
use App\Services\Professionals\ServiceService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function __construct(
        private ServiceService $service
    )
    {
    }

    public function index(Request $request)
    {
        $services = $this->service->getAll($request);

        return Inertia::render('Professionals/Services/Index', [
            'services' => $services,
            'query' => $request->query(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Professionals/Services/Create');
    }

    public function store(ServiceRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('services.index')->toast('Serviço criado com sucesso!');
    }

    public function edit(Service $service)
    {
        return Inertia::render('Professionals/Services/Edit', [
            'service' => $service,
        ]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        $service->update($data);
        return redirect()->route('services.index')->toast('Serviço atualizado com sucesso!');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->toast('Serviço deletado com sucesso!');
    }
}
