<?php

namespace Database\Seeders;

use App\Models\Equipamento;
use App\Models\User;
use Illuminate\Database\Seeder;

class EquipamentoSeeder extends Seeder
{
    public function run(): void
    {
        $clientePedro = User::where('email', 'cliente@email.com')->first();
        $clienteAna = User::where('email', 'cliente2@email.com')->first();

        Equipamento::create([
            'user_id' => $clientePedro->id,
            'tipo' => 'Console',
            'marca' => 'Sony',
            'modelo' => 'PlayStation 5',
            'numero_serie' => 'PS5-0001',
            'descricao' => 'Console não liga, luz azul piscando.',
        ]);

        Equipamento::create([
            'user_id' => $clientePedro->id,
            'tipo' => 'PC Gamer',
            'marca' => 'Montado',
            'modelo' => 'Ryzen 5 / RTX 3060',
            'numero_serie' => 'PC-0002',
            'descricao' => 'Travamentos frequentes durante jogos.',
        ]);

        Equipamento::create([
            'user_id' => $clienteAna->id,
            'tipo' => 'Console',
            'marca' => 'Microsoft',
            'modelo' => 'Xbox Series X',
            'numero_serie' => 'XBX-0003',
            'descricao' => 'Leitor de disco não reconhece a mídia.',
        ]);

        Equipamento::create([
            'user_id' => $clienteAna->id,
            'tipo' => 'Notebook Gamer',
            'marca' => 'Dell',
            'modelo' => 'G15',
            'numero_serie' => 'NB-0004',
            'descricao' => 'Superaquecimento e desligamento repentino.',
        ]);
    }
}
