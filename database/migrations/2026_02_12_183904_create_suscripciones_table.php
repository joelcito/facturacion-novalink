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
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->id('idsuscripciones');

        $table->unsignedBigInteger('planes_idplanes'); // relación con Plan
        $table->unsignedBigInteger('empresas_idempresas'); // relación con Empresa
        $table->date('fecha_inicio');
        $table->date('fecha_fin')->nullable();
        $table->string('estado', 45)->default('activa'); // activa, vencida, cancelada
        $table->timestamps();

        // Relaciones
        $table->foreign('planes_idplanes')
              ->references('idplanes')
              ->on('planes')
              ->onDelete('cascade');

        $table->foreign('empresas_idempresas')
              ->references('idempresas')
              ->on('empresas')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscripciones');
    }
};
