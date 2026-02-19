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
        Schema::create('producto_servicios', function (Blueprint $table) {
            $table->id('idproducto_servicios');

            $table->string('codigo_ambiente', 45);
            $table->string('codigo_actividad', 45);
            $table->string('codigo_producto', 45);
            $table->string('descripcion_producto', 255)->nullable();
            $table->string('mandina_pri', 45);
            $table->string('mandina_seg', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_servicios');
    }
};
