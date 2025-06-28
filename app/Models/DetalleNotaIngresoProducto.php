<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleNotaIngresoProducto extends Model
{
    use HasFactory;

    protected $table = 'detalle_notas_ingreso_productos';

    protected $fillable = [
        'nota_ingreso_producto_id',
        'product_id',
        'cantidad',
    ];
    

    public function notaIngreso()
    {
        return $this->belongsTo(NotaIngresoProducto::class, 'nota_ingreso_producto_id');
    }

    public function producto()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
