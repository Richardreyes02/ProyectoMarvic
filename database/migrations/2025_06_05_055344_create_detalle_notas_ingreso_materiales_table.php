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
        Schema::create('detalle_notas_ingreso_materiales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nota_ingreso_id')->constrained('notas_ingreso_materiales')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials');
            $table->decimal('cantidad', 10, 2);
            $table->string('unidad_medida');
            $table->decimal('costo_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_notas_ingreso_materiales');
    }
};
