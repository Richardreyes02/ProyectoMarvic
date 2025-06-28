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
        Schema::create('detalle_notas_ingreso_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nota_ingreso_producto_id')->constrained('notas_ingreso_productos')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_notas_ingreso_productos');
    }
};
