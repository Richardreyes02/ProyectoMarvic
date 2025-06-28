<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotaSalidaMaterial extends Model
{
    use HasFactory;

    protected $table = 'notas_salida_materiales';

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

    public function detalles()
    {
        return $this->hasMany(DetalleNotaSalidaMaterial::class, 'nota_salida_id');
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
