<?php

namespace App\Http\Controllers\Professionals;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ConfigController extends Controller
{
    public function show()
    {
        $config = auth()->user()->config;
        return Inertia::render('Professionals/Config/Index', [
            'config' => $config
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
            'color_primary' => 'required|string',
            'color_secondary' => 'required|string',
        ]);

        $data = $request->all();

        if ($data['color_primary'][0] !== '#') {
            $data['color_primary'] = '#' . $data['color_primary'];
        }

        if ($data['color_secondary'][0] !== '#') {
            $data['color_secondary'] = '#' . $data['color_secondary'];
        }

        auth()->user()->config()->update($data);

        return redirect()->route('config.show')->toast('Configurações atualizadas com sucesso!');
    }

    public function updateBanner(Request $request)
    {
        $request->validate([
            'banner_image' => $request->hasFile('banner_image') ? 'image|mimes:jpeg,png,jpg|max:2048' : 'nullable|string',
        ]);

        if ($request->hasFile('banner_image')) {
            Storage::disk('public')->delete(auth()->user()->config->banner_image);
            $path = $request->file('banner_image')->store('banners', 'public');
            $url = Storage::disk('public')->url($path);
            auth()->user()->config()->update(['banner_image' => $url]);
        }

        return redirect()->route('config.show')->toast('Banner atualizado com sucesso!');
    }
}
