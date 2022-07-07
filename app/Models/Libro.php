<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [

        'titulo',
        'sinopsis',
        'id_genero',
        'id_autor',
        'fecha',
        'stock',
        'precio',
        'idioma',
        'portada'
    ];

    public function GENERO(){
        return $this->belongsTo(Generos::class, 'id_genero');
    }
    public function AUTOR(){
        return $this->belongsTo(Autores::class, 'id_autor');
    }
}
