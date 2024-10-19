<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Luis Henrique',
            'email' => 'junimhs10@gmail.com',
            'password' => bcrypt('junior'),
        ]);

        $user->config()->create([
            'bio' => 'Olá, seja bem-vindo(a) ao meu perfil!',
            'banner_image' => 'default',
            'color_primary' => '#433BCE',
            'color_secondary' => '#FFFFFF',
        ]);
    }
}
