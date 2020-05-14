<?php

namespace App\Policies;

use App\AlphaSignUp;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function in_array;

class AlphaSignUpPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return in_array($user->email, User::$AdminEmails);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(?User $user)
    {
        return true;
    }
}
