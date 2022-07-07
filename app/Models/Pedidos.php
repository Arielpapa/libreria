<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = [
        'fecha_envio',
        'fecha_entrega',
        'estado',
        'cantidad'
    ];

}
