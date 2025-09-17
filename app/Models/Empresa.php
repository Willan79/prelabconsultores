<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    // Atributos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'nit',
        'razon_social',
        'num_trabajadores',
        'ciudad',
        'direccion'
    ];

    //Relación: una empresa puede tener muchas auditorías
    public function auditorias()
    {
        return $this->hasMany(Auditoria::class);
    }

    public function estandars()
    {
        return $this->hasMany(Estandar::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
