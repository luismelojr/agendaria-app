<?php

namespace App\Services\Me;

use App\Models\User;

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
}
