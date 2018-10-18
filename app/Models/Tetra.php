<?php

namespace App;

use App\Models\Campus;
use App\Models\Users\Tutor;
use App\Models\Users\Alumno;
use App\Models\Users\Gerente;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year','tetra','campus_id'
    ];

    /**
     * Get the campus the Tetra belongs to.
     *
     * @return BelongsTo
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    /**
     * Get the alumnos that belong to the tetra.
     *
     * @return HasMany
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }

    /**
     * Get the tutoes that belong to the tetra.
     *
     * @return BelongsTo
     */
    public function tutores()
    {
        return $this->hasMany(Tutor::class);
    }
}
