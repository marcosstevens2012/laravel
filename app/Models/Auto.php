<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Auto extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'modelo',
        'anio',
        'precio',
        'color',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    /**
     * Relación muchos a uno con marca
     */
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }
}
