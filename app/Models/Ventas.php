<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $table = "ventas";

    protected $fillable = [
        'id_cliente',
        'id_vendedor',
        'estado',
        'fecha',
        'total'
    ];

    public function CLIENTE(){
        return $this->belongsTo(Clientes::class, 'id_cliente');
    }
    public function VENDEDOR(){
        return $this->belongsTo(User::class, 'id_vendedor');
    }
}
