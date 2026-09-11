<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordens_servico';

    protected $fillable = [
        'equipamento_id',
        'tecnico_id',
        'descricao_problema',
        'diagnostico',
        'status',
        'valor_total',
        'data_abertura',
        'data_fechamento',
    ];

    protected $casts = [
        'data_abertura' => 'date',
        'data_fechamento' => 'date',
        'valor_total' => 'decimal:2',
    ];

    public const STATUS = [
        'aberta' => 'Aberta',
        'em_andamento' => 'Em andamento',
        'concluida' => 'Concluída',
        'cancelada' => 'Cancelada',
    ];

    public function equipamento(): BelongsTo
    {
        return $this->belongsTo(Equipamento::class);
    }

    public function tecnico(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }

    public function pecas(): HasMany
    {
        return $this->hasMany(Peca::class);
    }
}