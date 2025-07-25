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
        Schema::create('detalle_notas_salida_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nota_salida_id')->constrained('notas_salida_productos')->onDelete('cascade');
            $table->foreignId('producto_id')->constrained('products');
            $table->decimal('cantidad', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_notas_salida_productos');
    }
};
