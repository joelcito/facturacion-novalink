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
        Schema::create('motivo_anulaciones', function (Blueprint $table) {
            $table->id('idmotivo_anulaciones');

            $table->string('tipo_clasificador', 45);
            $table->string('descripcion', 255);
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
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motivo_anulaciones');
    }
};
