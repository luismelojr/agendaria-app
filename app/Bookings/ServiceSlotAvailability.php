<?php

namespace App\Bookings;

use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\Period\Period;
use Spatie\Period\PeriodCollection;

class ServiceSlotAvailability
{
    public function __construct(protected User $employee, protected Service $service)
    {
    }

    public function forPeriod(Carbon $startsAt, Carbon $endsAt)
    {
        $range = (new SlotRangeGenerator($startsAt, $endsAt))->generate($this->service->duration);

        $periods = (new ScheduleAvailability($this->employee, $this->service))->forPeriod($startsAt, $endsAt);

        foreach ($periods as $period) {
            $this->addAvailableEmployeeForPeriod($range, $period, $this->employee);
        };

        $range = $this->removeEmptySlots($range);


        return $range;
    }

    protected function addAvailableEmployeeForPeriod(Collection $range, Period $period, User $employee)
    {
        $range->each(function (Date $date) use ($period, $employee) {
            $date->slots->each(function (Slot $slot) use ($period, $employee) {
                if ($period->contains($slot->time)) {
                    $slot->addEmployee($employee);
                }
            });
        });
    }

    protected function removeEmptySlots(Collection $range)
    {
        return $range->filter(function (Date $date) {
            $date->slots = $date->slots->filter(function (Slot $slot) {
                return $slot->hasEmployees();
            });

            return true;
        });
    }
}
