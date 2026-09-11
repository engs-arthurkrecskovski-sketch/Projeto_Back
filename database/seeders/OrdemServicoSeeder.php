<?php

namespace Database\Seeders;

use App\Models\Equipamento;
use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrdemServicoSeeder extends Seeder
{
    public function run(): void
    {
        $tecnico = User::where('email', 'tecnico@email.com')->first();
        $equipamentos = Equipamento::all();

        OrdemServico::create([
            'equipamento_id' => $equipamentos[0]->id,
            'tecnico_id' => $tecnico->id,
            'descricao_problema' => 'Console não liga, luz azul piscando e desliga sozinho.',
            'diagnostico' => 'Fonte de alimentação com defeito.',
            'status' => 'em_andamento',
            'valor_total' => 250.00,
            'data_abertura' => now()->subDays(5),
        ]);

        OrdemServico::create([
            'equipamento_id' => $equipamentos[1]->id,
            'tecnico_id' => null,
            'descricao_problema' => 'PC trava durante jogos pesados após 20 minutos de uso.',
            'status' => 'aberta',
            'data_abertura' => now()->subDays(2),
        ]);

        OrdemServico::create([
            'equipamento_id' => $equipamentos[2]->id,
            'tecnico_id' => $tecnico->id,
            'descricao_problema' => 'Leitor de disco não reconhece mídias.',
            'diagnostico' => 'Lente do leitor suja, realizada limpeza.',
            'status' => 'concluida',
            'valor_total' => 120.00,
            'data_abertura' => now()->subDays(10),
            'data_fechamento' => now()->subDays(8),
        ]);

        OrdemServico::create([
            'equipamento_id' => $equipamentos[3]->id,
            'tecnico_id' => null,
            'descricao_problema' => 'Notebook desliga sozinho por superaquecimento.',
            'status' => 'aberta',
            'data_abertura' => now()->subDay(),
        ]);
    }
}
