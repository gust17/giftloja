<?php

namespace App\Policies;

use App\Models\Parceira;
use App\Models\User;

class ParceiraPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Parceira $parceira)
    {
        return $user->responsavels->contains('parceira_id', $parceira->id);

    }
}
