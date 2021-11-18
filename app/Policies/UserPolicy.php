<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @param User $user
     * @return boolean
     */
    public function manage(User $user)
    {
        return $user->role == 'manager';
    }

    public function employee(User $user)
    {
        return $user->role == 'employee';
    }

    public function delete(User $user)
    {
        return $user->role == 'employee' || $user->role == 'manager';
    }
}
