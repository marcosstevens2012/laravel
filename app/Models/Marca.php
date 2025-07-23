<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'pais_origen',
    ];

    /**
     * Relación uno a muchos con autos
     */
    public function autos(): HasMany
    {
        return $this->hasMany(Auto::class);
    }
}
