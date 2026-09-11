<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@email.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Técnico João',
            'email' => 'tecnico@email.com',
            'password' => Hash::make('12345678'),
            'role' => 'tecnico',
        ]);

        User::create([
            'name' => 'Técnica Maria',
            'email' => 'tecnica2@email.com',
            'password' => Hash::make('12345678'),
            'role' => 'tecnico',
        ]);

        User::create([
            'name' => 'Cliente Pedro',
            'email' => 'cliente@email.com',
            'password' => Hash::make('12345678'),
            'role' => 'cliente',
        ]);

        User::create([
            'name' => 'Cliente Ana',
            'email' => 'cliente2@email.com',
            'password' => Hash::make('12345678'),
            'role' => 'cliente',
        ]);
    }
}
