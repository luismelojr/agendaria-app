<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Clients\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(
        private ClientService $service
    ){}

    public function sendCode(Request $request)
    {
        $request->validate([
           'phone' => 'required|numeric|digits:11'
        ]);

        $this->service->createCode($request->phone);

        return response()->json([
            'message' => 'Código enviado com sucesso!',
        ]);
    }

    public function validationCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:11',
            'code' => 'required|numeric|digits:4'
        ]);

        if (!$response = $this->service->validationCode($request->phone, $request->code)) {
            return response()->json([
                'message' => 'Código inválido!',
                'error' => true
            ], 400);
        }

        return response()->json([
            'message' => 'Código validado com sucesso!',
            'error' => false,
            'client' => [
                'id' => $response->id,
                'name' => $response->name,
            ]
        ]);
    }
}
