<?php

namespace App\Models\Aplicaciones;

use App\Models\Campus;
use App\Models\Tetra;
use App\Models\Users\Gerente;
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
        'tetra_id', 'gerente_id', 'birth_date',
        'campus_code'
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
     * Get the tetra to which the tutor belongs.
     *
     * @return BelongsTo
     */
    public function tetra()
    {
        return $this->belongsTo(Tetra::class);
    }

    /**
     * Get the tetra to which the tutor belongs.
     *
     * @return BelongsTo
     */
    public function gerente()
    {
        return $this->belongsTo(Gerente::class);
    }

    /**
     * Get the tetra to which the tutor belongs.
     *
     * @return BelongsTo
     */
    public function isDeletable()
    {
        return true;
    }
}
