<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Services\Appointments\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct(
        private AppointmentService $service
    ){}

    public function store(AppointmentRequest $request)
    {
        $data = $request->validated();
        $user = $this->service->sendAppointment($data);

        return redirect()->route('me.home', $user->email)->toast('Agendamento realizado com sucesso!');
    }
}
