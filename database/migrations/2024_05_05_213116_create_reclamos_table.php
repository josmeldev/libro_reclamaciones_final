<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reclamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes');
            $table->foreignId('empresa_id')->nullable()->constrained('empresas');
            $table->enum('tipo_reclamo', ['reclamo', 'queja']);
            $table->enum('bien_contratado', ['producto', 'servicio']);
            $table->text('texto_reclamo')->nullable();
            $table->text('texto_queja')->nullable();
            $table->text('detalle_reclamacion');
            $table->tinyInteger('leido_aceptado');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->enum('estado', ['ATENDIDO', 'POR ATENDER', 'EN ATENCION'])->default('POR ATENDER');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reclamos');
    }
};
