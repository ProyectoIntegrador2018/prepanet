<?php

namespace App\Models\Users;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
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
        return 'Tutor';
    }

    /**
     * Get the campus to which the tutor belongs.
     *
     * @return BelongsTo
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
