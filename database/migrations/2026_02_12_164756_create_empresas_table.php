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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id('idempresas')->primary();
                        
            $table->string('nombre', 45);
            $table->string('nit', 45);
            $table->string('razon_social', 255);
            $table->string('celular', 45)->nullable();
            $table->string('codigo_ambiente', 45)->nullable();
            $table->string('codigo_modalidad', 45)->nullable();
            $table->string('codigo_sistema', 45)->nullable();
            $table->string('codigo_documento_sector', 45)->nullable();
            $table->Text('api_key')->nullable();
            $table->string('cafc', 45)->nullable();           
            $table->string('archivop12', 45)->nullable();
            $table->string('contrasenia', 45)->nullable();
            $table->string('estado',45)->nullable();
            //
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
        Schema::dropIfExists('empresas');
    }
};
