<?php

/*
|--------------------------------------------------------------------------
| Model: Empresa
|--------------------------------------------------------------------------
| Representa una empresa dentro del sistema.
|
| Responsabilidades:
| - Definir atributos asignables masivamente
| - Declarar relaciones con otros modelos
|
| Relaciones:
| - Una empresa tiene muchas auditorías
| - Una empresa tiene muchos estándares
| - Una empresa pertenece a un usuario
|--------------------------------------------------------------------------
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empresa extends Model
{
    use HasFactory;

    /**
     * Atributos asignables masivamente
     */
    protected $fillable = [
        'nombre',
        'nit',
        'razon_social',
        'num_trabajadores',
        'ciudad',
        'direccion',
        'user_id',
    ];

    public function auditorias(): HasMany
    {
        return $this->hasMany(Auditoria::class);
    }

    public function estandares(): HasMany
    {
        return $this->hasMany(Estandar::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
