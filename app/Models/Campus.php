<?php

namespace App\Models;

use App\Models\Tetra;
use App\Models\Users\Gerente;
use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','code',
    ];

    /**
     * Get all of the tetras of the campus.
     *
     * @return HasMany
     */
    public function years()
    {
        return $this->hasMany(Year::class);
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

    public function alumnoUserName()
    {
        return "p000" . (string)($this->alumnos->count() + 1);
    }

    /**
     * Return if the campus is deletable
     *
     * @return true
     */
    public function isDeletable()
    {
        return true;
    }
}
