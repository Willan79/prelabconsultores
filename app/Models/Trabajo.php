<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Trabajo
 *
 * Representa los trabajos o proyectos asociados a una empresa.
 *
 * Campos principales:
 * - titulo: Nombre del trabajo
 * - descripcion: Detalle del trabajo realizado
 * - empresa_id: Empresa a la que pertenece el trabajo
 *
 * Relaciones:
 * - Pertenece a una empresa
 * - Tiene muchas imágenes asociadas
 */
class Trabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'empresa_id',
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function imagens(): HasMany
    {
        return $this->hasMany(Imagen::class);
    }
}
