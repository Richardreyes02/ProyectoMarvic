<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'codigo', 'descripcion', 'serie', 'cantidad', 'imagen'
    ];

}
