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
        Schema::create('notas_salida_productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->date('fecha');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('sede_id')->constrained('sedes');
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'confirmado', 'anulado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_salida_productos');
    }
};
