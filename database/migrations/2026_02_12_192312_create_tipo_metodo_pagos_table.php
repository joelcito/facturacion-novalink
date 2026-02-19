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
        Schema::create('tipo_metodo_pagos', function (Blueprint $table) {
            $table->id('idtipo_metodo_pagos');

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
        Schema::dropIfExists('tipo_metodo_pagos');
    }
};
