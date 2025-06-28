<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class NotaIngresoMaterial extends Model
{
    use HasFactory;

    protected $table = 'notas_ingreso_materiales';

    protected $fillable = [
        'codigo',
        'fecha',
        'proveedor_id',
        'tipo_documento',
        'numero_documento',
        'usuario_id',
        'sede_id',
        'observaciones',
        'estado',
    ];
    
    protected $casts = [
        'fecha' => 'date',
    ];


    public function proveedor() {
        return $this->belongsTo(Proveedor::class);
    }

    public function usuario() {
        return $this->belongsTo(User::class);
    }

    public function sede() {
        return $this->belongsTo(Sede::class);
    }

    public function detalles() {
        return $this->hasMany(DetalleNotaIngresoMaterial::class, 'nota_ingreso_id');
    }


}
