<?php

namespace App\Models;

use App\Models\Tetra;
use App\Models\Users\Tutor;
use App\Models\Users\Alumno;
use App\Models\Users\Gerente;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','address',
    ];

    /**
     * Get all of the tetras of the campus.
     *
     * @return HasMany
     */
    public function tetras()
    {
        return $this->hasMany(Tetra::class);
    }

    /**
     * Get all of the employees for the studio.
     *
     * @return HasMany
     */
    public function gerentes()
    {
        return $this->hasMany(Gerente::class);
    }

    /**
     * Get all of the alumnos for the campus
     *
     * @return HasMany
     */
    public function alumnos()
    {
        return $this->hasManyThrough(Alumno::class, Tetra::class);
    }

    /**
     * Get all of the tutores for the campus.
     *
     * @return HasMany
     */
    public function tutores()
    {
        return $this->hasManyThrough(Tutor::class, Tetra::class);
    }
}
