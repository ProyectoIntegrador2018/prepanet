<?php

namespace App\Models\Users;

use App\Traits\completeDeleteUser;
use Illuminate\Database\Eloquent\Model;

class SuperAdministrator extends Model
{
    use completeDeleteUser;
    /**
     * Get the customers user instance.
     *
     * @return MorphOne
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    /**
     * Returns the user type of the user.
     *
     * @return string
     */
    public function userType()
    {
        return 'Super Administrador';
    }
}
