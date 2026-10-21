<?php

namespace App\Policies;

use App\Models\Cita;
use App\Models\User;

class CitaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isDoctor();
    }

    public function view(User $user, Cita $cita): bool
    {
        return $user->isAdmin()
            || ($user->isDoctor() && (string) $cita->doctor_id === (string) $user->getKey());
    }

    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isDoctor();
    }

    public function update(User $user, Cita $cita): bool
    {
        return $this->view($user, $cita);
    }

    public function delete(User $user, Cita $cita): bool
    {
        return $this->view($user, $cita);
    }
}
