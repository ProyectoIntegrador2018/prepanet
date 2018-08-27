<?php

namespace App\Models\Aplicaciones;

use App\Models\Users\Alumno;
use Illuminate\Database\Eloquent\Model;

class AplicacionAlumno extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'gender', 'age',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'submitted_on'
    ];

    /**
     * Get the student to which the application belongs.
     *
     * @return BelongsTo
     */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }
}
