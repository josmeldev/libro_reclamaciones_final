<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres_apellidos', 'dni', 'email', 'fono_persona', 'menor_edad', 'tipo_persona',
    ];

    // Relación con reclamos
    public function reclamos()
    {
        return $this->hasMany(Reclamo::class, 'cliente_id');
    }
    public function apoderado()
    {
        return $this->hasOne(Apoderado::class, 'id_cliente');
    }
}
