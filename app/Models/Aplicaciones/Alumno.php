<?php

namespace App\Models\Aplicaciones;

use App\Models\Campus;
use App\Models\Tetra;
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
        'gerente_id', 'tetra_id'
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
     * Get the tetra to which the tutor belongs.
     *
     * @return BelongsTo
     */
    public function tetra()
    {
        return $this->belongsTo(Tetra::class);
    }
}
