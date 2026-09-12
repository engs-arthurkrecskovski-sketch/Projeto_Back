<?php

namespace App\Policies;

use App\Models\OrdemServico;
use App\Models\User;

class OrdemServicoPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'tecnico', 'cliente'], true);
    }

    public function view(User $user, OrdemServico $ordem): bool
    {
        if ($user->isAdmin() || $user->isTecnico()) {
            return true;
        }

        return $user->isCliente()
            && $ordem->equipamento?->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'tecnico', 'cliente'], true);
    }

    public function update(User $user, OrdemServico $ordem): bool
    {
        return $user->isAdmin()
            || ($user->isTecnico() && $ordem->tecnico_id === $user->id);
    }

    public function delete(User $user, OrdemServico $ordem): bool
    {
        return $user->isAdmin();
    }
}