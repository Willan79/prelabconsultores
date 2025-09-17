<?php

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
