<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNotaSalidaMaterial extends Model
{
    use HasFactory;

    protected $table = 'detalle_notas_salida_materiales';

    protected $fillable = [
        'nota_salida_id',
        'material_id',
        'cantidad',
        'unidad_medida',
    ];

    public function notaSalida()
    {
        return $this->belongsTo(NotaSalidaMaterial::class, 'nota_salida_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
