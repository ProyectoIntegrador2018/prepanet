<?php

namespace App\Models\Aplicaciones;

use App\Models\Campus;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'gender',
        'work_email', 'email', 'phone',
        'city', 'state', 'country',
        'tutor_type', 'carreer', 'business',
        'gerente_id', 'campus_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birth_date'
    ];

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
