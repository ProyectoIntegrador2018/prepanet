<?php

namespace App\Models\Users;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Model;

class Gerente extends Model
{
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
        return 'Gerente';
    }

    /**
     * Get the tutor to which the application belongs.
     *
     * @return BelongsTo
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
