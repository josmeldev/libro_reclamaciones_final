<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon_social', 'ruc', 'direccion', 'fono_empresa', 'tipo_persona',
    ];

    // Relación con reclamos
    public function reclamos()
    {
        return $this->hasMany(Reclamo::class, 'empresa_id');
    }
}
