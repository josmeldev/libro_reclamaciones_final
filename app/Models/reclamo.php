<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reclamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'empresa_id', 'tipo_reclamo', 'bien_contratado', 'texto_reclamo', 'texto_queja', 'detalle_reclamacion', 'leido_aceptado',
    ];

    // Relación con cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
