<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Sede;
use App\Models\DetalleNotaIngresoProducto;

class NotaIngresoProducto extends Model
{
    use HasFactory;

    protected $table = 'notas_ingreso_productos';

    protected $fillable = [
        'codigo',
        'fecha',
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

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleNotaIngresoProducto::class, 'nota_ingreso_producto_id');
    }
}
