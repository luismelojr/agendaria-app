<?php

namespace App\Services\Me;

use App\Bookings\ServiceSlotAvailability;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeService
{
    public function __construct(
        private User $userModel
    ){}

    public function getMe($email)
    {
        /** @var User $user */
        $user = $this->userModel->active()->where('email', $email)->firstOrFail();
        $user->load(['services', 'config', 'schedules']);

        return $user;
    }

    public function getScheduleAndEmail(string $email, string $serviceID, Request $request)
    {
        $user = $this->userModel->active()->where('email', $email)->firstOrFail();
        $user->load(['config']);
        $service = $user->services->find($serviceID);
        $availability = (new ServiceSlotAvailability($user, $service))->forPeriod(
            Carbon::createFromDate($request->calendar)->startOfDay(),
            Carbon::createFromDate($request->calendar)->endOfMonth()
        );

        $availabilityDates = $availability->hasSlots();


        return [
            'user' => $user,
            'service' => $service,
            'availability' => $availabilityDates,
            'date' => $availability->firstAvailableDate()?->date->toDateString()
        ];
    }
}
