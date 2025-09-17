<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $fillable = ['trabajo_id', 'ruta'];

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }
}
