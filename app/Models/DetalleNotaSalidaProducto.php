<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleNotaSalidaProducto extends Model
{
    use HasFactory;

    protected $table = 'detalle_notas_salida_productos';

    protected $fillable = [
        'nota_salida_id',
        'producto_id',
        'cantidad'
    ];

    public function notaSalida() {
        return $this->belongsTo(NotaSalidaProducto::class, 'nota_salida_id');
    }

    public function producto() {
        return $this->belongsTo(Product::class);
    }
}
