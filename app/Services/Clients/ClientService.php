<?php

namespace App\Services\Clients;

use App\Models\Client;

class ClientService
{
    public function __construct(
        private Client $client
    ){}

    public function createCode($phone)
    {
        $code = rand(1000, 9999);
        $client = $this->client->where('phone', $phone)->first();
        if ($client) {
            $client->update([
                'code' => $code
            ]);
        } else {
            $this->client->create([
                'phone' => $phone,
                'code' => $code
            ]);
        }

        return $client;
    }

    public function validationCode($phone, $code): Client | false
    {
        $client = $this->client->where('phone', $phone)->where('code', $code)->first();
        if ($client) {
            $client->update([
                'code' => null
            ]);
        } else {
            return false;
        }

        return $client;
    }
}
