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
        Schema::create('url_apis_servicios_siat', function (Blueprint $table) {
            $table->id('idurl_apis_servicios_siat');

            $table->unsignedBigInteger('tipo_documento_sectores_idtipo_documento_sectores');

            $table->string('ambiente', 45);
            $table->string('modalidad', 45);
            $table->string('nombre', 45);
            $table->string('url_servicio');

            $table->string('estado', 45)->nullable();
            
            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_modificador_id')->nullable()->after('usuario_creador_id');
            $table->foreign('usuario_modificador_id')->references('idusers')->on('users');
            $table->unsignedBigInteger('usuario_eliminador_id')->nullable()->after('usuario_modificador_id');
            $table->foreign('usuario_eliminador_id')->references('idusers')->on('users');
            $table->integer('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('tipo_documento_sectores_idtipo_documento_sectores')->references('idtipo_documento_sectores')->on('tipo_documento_sectores');
            
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_apis_servicios_siat');
    }
};
