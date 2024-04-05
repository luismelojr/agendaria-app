<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professionals\ScheduleRequest;
use Illuminate\Http\Request;

class HoursController extends Controller
{
    public function __construct(){}

    public function show()
    {
        $user = auth()->user();
        return inertia('Professionals/Hours/Index', [
            'schedule' => $user->schedules()->first()
        ]);
    }

    public function update(ScheduleRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        if (collect($data)->every(fn($value) => is_null($value))) {
            return redirect()->back()->toast('Cadastre ao menos um horário de atendimento', 'error');
        }

        if ($user->schedules()->count() === 0) {
            $data['starts_at'] = now();
            $data['ends_at'] = now()->addYear();
            $user->schedules()->create($data);
            return redirect()->back()->toast('Horários de atendimento cadastrados com sucesso');
        }

        $user->schedules()->first()->update($data);
        return redirect()->back()->toast('Horários de atendimento atualizados com sucesso');
    }
}
