<?php

/*
|--------------------------------------------------------------------------
| Model: Auditoria
|--------------------------------------------------------------------------
| Representa una auditoría realizada a una empresa.
|
| Responsabilidades:
| - Definir atributos asignables
| - Declarar relaciones con Empresa y User
| - Configurar casts de atributos
|
| Relaciones:
| - Pertenece a una Empresa
| - Pertenece a un Usuario (consultor/admin)
|--------------------------------------------------------------------------
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Auditoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id',
        'user_id',
        'fecha',
        'resultado',
        'observaciones',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
