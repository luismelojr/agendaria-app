<?php

namespace App\Services\Professionals;

use App\Models\Brand;
use App\Models\Service;
use App\Services\ServiceGeneric;
use Illuminate\Http\Request;

class ServiceService extends ServiceGeneric
{
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function getAll(Request $request)
    {
        return auth()->user()->services()->when($request->search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('duration', 'like', "%$search%");
        })->paginate(5);
    }

    public function create(array $data)
    {
        $user = auth()->user();
        return $user->services()->create($data);
    }
}
