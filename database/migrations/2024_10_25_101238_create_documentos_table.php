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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idtipo_documento')->constrained('tipos_documento')->onDelete('cascade');
            $table->string('numero', 100);
            $table->date('fecha');
            $table->dateTime('fechapubli');
            $table->string('sumilla', 800);
            $table->string('url');
            $table->foreignId('idestado')->constrained('estados_documento')->onDelete('cascade');
            $table->text('html')->nullable();
            $table->string('titulo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
