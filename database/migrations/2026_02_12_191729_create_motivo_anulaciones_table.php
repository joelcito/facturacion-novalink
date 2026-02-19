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

            $table->timestamps();
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
