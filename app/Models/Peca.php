<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peca extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordem_servico_id',
        'nome',
        'quantidade',
        'valor_unitario',
    ];

    public function ordemServico(): BelongsTo
    {
        return $this->belongsTo(OrdemServico::class);
    }
}
