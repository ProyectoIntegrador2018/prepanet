<?php

namespace App\Models\Aplicaciones;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email',
        'phone', 'work_phone', 'gender',
        'street', 'street_number', 'neighborhood',
        'community', 'city', 'zipcode',
        'state', 'country', 'user_name',
        'campus_id', 'gerente_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_password',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birth_date'
    ];

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
