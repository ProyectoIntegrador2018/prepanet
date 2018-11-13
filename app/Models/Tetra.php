<?php

namespace App\Models;

use Config;
use App\Models\Campus;
use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use App\Models\Users\Gerente;
use Illuminate\Database\Eloquent\Model;

class Tetra extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year','type','goal','campus_id', 'identifier',
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

    /**
     * Get the tutoes that belong to the tetra.
     *
     * @return BelongsTo
     */
    public function isDeletable()
    {
        return true;
    }

    public function countTotal(){
        return $this->alumnos->count() + $this->tutores->count();
    }

    public function tipoTetra(){
        $types = Config::get('tetras');
        foreach ($types as $id => $name){
            if ($this->type == $id){
                return $name;
            }
        }
    }

    public function grupoTutor(){
        return (integer) round($this->tutores->count()/15,0,PHP_ROUND_HALF_DOWN)+1;
    }
}
