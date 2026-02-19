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
        Schema::create('tipo_punto_ventas', function (Blueprint $table) {
            $table->id('idtipo_punto_ventas');

            $table->string('codigo_clasificador', 45);
            $table->string('descripcion', 255);
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_punto_ventas');
    }
};
