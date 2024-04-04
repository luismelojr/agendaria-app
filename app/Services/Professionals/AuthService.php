<?php

namespace App\Services\Professionals;

use App\Models\User;

class AuthService
{
    public function __construct(
        private User $model
    ){}

    public function register(array $data)
    {
        dd($data);
    }
}
