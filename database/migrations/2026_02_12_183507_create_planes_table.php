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
        Schema::create('planes', function (Blueprint $table) {
            $table->id('idplanes');

            $table->decimal('precio', 12, 2);
            $table->string('nombre', 45);
            $table->string('tipo_plan', 45);
            $table->decimal('cantidad_facturas', 12, 2);
            $table->decimal('cantidad_sucursal', 12, 2);
            $table->decimal('cantidad_punto_venta', 12, 2);
            $table->decimal('cantidad_usuario', 12, 2);
            $table->decimal('cantidad_producto', 12, 2);
            $table->decimal('cantidad_cliente', 12, 2);
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};
