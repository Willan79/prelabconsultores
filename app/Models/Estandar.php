<?php

/*
|--------------------------------------------------------------------------
| Model: Estandar
|--------------------------------------------------------------------------
| Representa un documento/estándar asociado a una empresa.
|
| Responsabilidades:
| - Definir atributos asignables (fillable)
| - Gestionar relaciones con Empresa y User
| - Manejar archivos almacenados (documentos)
|
| Relaciones:
| - Pertenece a una Empresa
| - Pertenece a un Usuario (quien subió el documento)
|--------------------------------------------------------------------------
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estandar extends Model
{
    use HasFactory;
    // Atributos que pueden ser asignados masivamente
    protected $fillable = [
        'empresa_id',
        'nombre',
        'archivo',
        'user_id',
    ];

    // Relación inversa: documento pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
