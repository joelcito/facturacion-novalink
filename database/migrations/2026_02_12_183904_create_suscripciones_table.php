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
            
            $table->unsignedBigInteger('empresas_idempresas'); // relación con Empresa
            $table->unsignedBigInteger('planes_idplanes'); // relación con Plan

            $table->date('fecha_inicio');
            $table->date('ampliacion_cantidad_facturas')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->date('descripcion')->nullable();
            $table->string('estado', 45)->default('activa'); // activa, vencida, cancelada
            
            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable()->after('usuario_creador_id');
            $table->foreign('usuario_modificador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable()->after('usuario_modificador_id');
            $table->foreign('usuario_eliminador_id')->references('idusers')->on('users');
            $table->integer('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();

        // Relaciones
         $table->foreign('empresas_idempresas')->references('idempresas')->on('empresas');
         $table->foreign('planes_idplanes')->references('idplanes')->on('planes');
        
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
