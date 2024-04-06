<?php

namespace App\Services\Professionals;

use Illuminate\Http\Request;

class ServiceService
{
    public function getAll(Request $request)
    {
        return auth()->user()->services()->when($request->search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('duration', 'like', "%$search%");
        })->paginate(3);
    }

    public function create(array $data)
    {
        $user = auth()->user();
        return $user->services()->create($data);
    }
}
