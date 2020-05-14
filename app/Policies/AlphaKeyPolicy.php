<?php

namespace App\Policies;

use App\AlphaKey;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function in_array;

class AlphaKeyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->email, User::$AdminEmails);
    }

    /**
     * Determine whether the user can send mails.
     *
     * @param User $user
     * @param AlphaKey $alphaKey
     * @return mixed
     */
    public function sendMail(User $user, AlphaKey $alphaKey)
    {
        return in_array($user->email, User::$AdminEmails);
    }
}
