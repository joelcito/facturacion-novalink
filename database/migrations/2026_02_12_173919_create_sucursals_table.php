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
        Schema::create('sucursales', function (Blueprint $table) {

            $table->id('idsucursales');

            $table->foreignId('empresas_idempresas')
                ->constrained('empresas', 'idempresas');

            $table->string('nombre', 255);
            $table->string('codigo_sucursal', 45);
            $table->text('direccion')->nullable();
            $table->string('celular', 45)->nullable();
            $table->string('municipio', 45)->nullable();
            $table->string('estado', 45)->nullable();

            $table->foreignId('usuario_creador_id')
                ->constrained('users', 'idusers');

            $table->foreignId('usuario_modificador_id')
                ->nullable()
                ->constrained('users', 'idusers');

            $table->foreignId('usuario_eliminador_id')
                ->nullable()
                ->constrained('users', 'idusers');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
