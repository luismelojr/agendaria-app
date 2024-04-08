<?php

namespace App\Services\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;

class AppointmentService
{
    public function __construct(
        private Appointment $appointment
    ){}

    public function sendAppointment(array $data)
    {
        $service = Service::find($data['service_id']);
        $user = User::find($data['user_id']);
        $client = Client::find($data['client_id']);
        $client->update([
            'name' => $data['name'],
        ]);
        $timer = $service->duration + $service->time_extra;

        $this->appointment->create([
            'service_id' => $data['service_id'],
            'client_id' => $data['client_id'],
            'user_id' => $data['user_id'],
            'starts_at' => $data['datetime'],
            'ends_at' => Carbon::parse($data['datetime'])->addMinutes($timer),
        ]);

        return $user;
    }
}
