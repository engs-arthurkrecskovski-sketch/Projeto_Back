<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo',
        'marca',
        'modelo',
        'numero_serie',
        'descricao',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ordensServico(): HasMany
    {
        return $this->hasMany(OrdemServico::class);
    }
}