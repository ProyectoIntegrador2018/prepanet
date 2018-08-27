<?php

namespace App\Models\Aplicaciones;

use App\Models\Users\Tutor;
use Illuminate\Database\Eloquent\Model;

class AplicacionTutor extends Model
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
     * Get the tutor to which the application belongs.
     *
     * @return BelongsTo
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}
