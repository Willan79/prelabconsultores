<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Imagen
 *
 * Representa las imágenes asociadas a un trabajo.
 * Cada imagen pertenece a un trabajo y almacena la ruta del archivo en el sistema.
 */
class Imagen extends Model
{
    use HasFactory;

    protected $fillable = [
        'trabajo_id',
        'ruta',
    ];

    /**
     * Conversión de tipos (mejora rendimiento y consistencia).
     */
    protected $casts = [
        'trabajo_id' => 'integer',
    ];

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }
}

