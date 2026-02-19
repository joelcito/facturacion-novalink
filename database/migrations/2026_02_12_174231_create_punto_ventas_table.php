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
        Schema::create('punto_ventas', function (Blueprint $table) {
            $table->id("idpuntoventas"); // id BIGINT automático        
            $table->unsignedBigInteger('sucursals_idsucursales');

            $table->string('codigoPuntoVenta', 255);
            $table->string('nombrePuntoVenta', 255);
            $table->string('tipoPuntoVenta', 255)->nullable();

            $table->timestamps();

            // Clave foránea
            $table->foreign('sucursals_idsucursales')
                ->references('idsucursales')
                ->on('sucursales');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punto_ventas');
    }
};
