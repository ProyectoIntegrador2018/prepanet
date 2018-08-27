<?php

namespace App\Models;

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
     * Get the trainingSession that is on the room.
     *
     * @return hasMany
     */
    public function trainingSessions()
    {
        return $this->hasMany(TrainingSession::class);
    }

    /**
     * Get all of the tutors of the campus.
     *
     * @return HasMany
     */
    public function tutors()
    {
        return $this->hasMany(Tutor::class);
    }

    /**
     * Get all of the students of the campus.
     *
     * @return HasMany
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
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
     * Get all of the applications of the tutors for the campus.
     *
     * @return HasMany
     */
    public function aplicacionesTutor()
    {
        return $this->hasManyThrough(AplicacionTutor::class, Tutor::class);
    }

    /**
     * Get all of the applications of the student for the campus.
     *
     * @return HasMany
     */
    public function aplicacionesAlumno()
    {
        return $this->hasManyThrough(AplicacionAlumno::class, Alumno::class);
    }
}
