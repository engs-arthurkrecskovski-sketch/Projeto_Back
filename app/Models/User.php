<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Equipamentos do usuário (quando ele é cliente)
    public function equipamentos(): HasMany
    {
        return $this->hasMany(Equipamento::class);
    }

    // Ordens de Serviço em que o usuário é o técnico responsável
    public function ordensServicoComoTecnico(): HasMany
    {
        return $this->hasMany(OrdemServico::class, 'tecnico_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTecnico(): bool
    {
        return $this->role === 'tecnico';
    }

    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }
}