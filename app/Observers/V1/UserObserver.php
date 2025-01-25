<?php

namespace App\Observers\V1;

use App\Models\V1\User;

class UserObserver
{
    public function created(User $user)
    {
        $user->wallet()->create();
    }
}
