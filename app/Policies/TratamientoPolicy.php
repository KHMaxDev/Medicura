<?php

namespace App\Policies;

use App\Models\Tratamiento;
use App\Models\User;

class TratamientoPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isDoctor();
    }

    public function view(User $user, Tratamiento $tratamiento): bool
    {
        return $user->isAdmin()
            || ($user->isDoctor() && (string) $tratamiento->doctor_id === (string) $user->getKey());
    }

    public function create(User $user): bool
    {
        return $user->isDoctor();
    }

    public function update(User $user, Tratamiento $tratamiento): bool
    {
        return $this->view($user, $tratamiento);
    }

    public function delete(User $user, Tratamiento $tratamiento): bool
    {
        return $this->view($user, $tratamiento);
    }
}
