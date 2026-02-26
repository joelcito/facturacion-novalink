<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {

            $table->id('idempresas');

            $table->string('nombre', 255);
            $table->string('nit', 45);
            $table->string('razon_social', 255);
            $table->string('celular', 45)->nullable();
            $table->string('codigo_ambiente', 45)->nullable();
            $table->string('codigo_modalidad', 45)->nullable();
            $table->string('codigo_sistema', 45)->nullable();
            $table->string('codigo_documento_sector', 45)->nullable();
            $table->text('api_key')->nullable();
            $table->string('cafc', 45)->nullable();
            $table->string('archivop12', 45)->nullable();
            $table->string('contrasenia', 45)->nullable();
            $table->string('estado',45)->nullable();

            // Foreign Keys
            $table->foreignId('usuario_creador_id')
                  ->constrained('users', 'idusers');

            $table->foreignId('usuario_modificador_id')
                  ->nullable()
                  ->constrained('users', 'idusers');

            $table->foreignId('usuario_eliminador_id')
                  ->nullable()
                  ->constrained('users', 'idusers');

            // Timestamps automáticos
            $table->timestamps();

            // Soft delete
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};