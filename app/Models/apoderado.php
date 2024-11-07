<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apoderado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cliente', 'nombres_apellidos_apoderado', 'dni_apoderado', 'direccion_apoderado',
    ];

    // Relación con cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
