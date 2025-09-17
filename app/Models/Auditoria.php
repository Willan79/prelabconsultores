<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;

    // Atributos que pueden ser asignados masivamente
    protected $fillable = [
        'empresa_id',
        'user_id',
        'fecha',
        'resultado',
        'observaciones',
        'estado',

    ];

    // Relación inversa: auditoría pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    // Relación inversa: auditoría fue realizada por un usuario (consultor)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
