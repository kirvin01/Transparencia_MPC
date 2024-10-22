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
        Schema::create('directorios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_categoria'); // Relación con otra tabla, si es necesario
            $table->string('foto')->nullable();
            $table->string('cargo');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamps(); // Campos 'created_at' y 'updated_at'

            // Definir la clave foránea
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directorios');
    }
};
