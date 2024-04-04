<?php

namespace App\Services\Professionals;

use App\Models\User;
use App\Notifications\WelcomeProfessionalsNotification;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function __construct(
        private User $model
    ){}

    public function register(array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->model->create($data);
            $user->notify(new WelcomeProfessionalsNotification($user));
            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
