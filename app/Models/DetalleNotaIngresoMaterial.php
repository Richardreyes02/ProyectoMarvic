<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleNotaIngresoMaterial extends Model
{
    use HasFactory;

    protected $table = 'detalle_notas_ingreso_materiales';

    protected $fillable = [
        'nota_ingreso_id',
        'material_id',
        'cantidad',
        'unidad_medida',
        'costo_unitario',
        'subtotal',
    ];

    public function notaIngreso()
    {
        return $this->belongsTo(NotaIngresoMaterial::class, 'nota_ingreso_id');
    }
    
    public function material() {
        return $this->belongsTo(Material::class);
    }

}
