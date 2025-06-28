<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaSalidaProducto extends Model
{
    use HasFactory;

    protected $table = 'notas_salida_productos';

    protected $fillable = [
        'codigo',
        'fecha',
        'tipo_documento',
        'numero_documento',
        'usuario_id',
        'sede_id',
        'observaciones',
        'estado'
    ];

    public function usuario() {
        return $this->belongsTo(User::class);
    }

    public function sede() {
        return $this->belongsTo(Sede::class);
    }

    public function detalles() {
        return $this->hasMany(DetalleNotaSalidaProducto::class, 'nota_salida_id');
    }
}
