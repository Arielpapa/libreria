<?php

namespace App\Http\Controllers;

use App\Models\Autores;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AutoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autores::all();

        return view('modulos.Autores')->with('autores', $autores);
    }

   
    public function create()
    {
        return view('modulos.Agregar-Autor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = request()->validate([
            'nombre' => ['required', 'string'],
            'biografia' => ['required', 'string'],
            'foto' => ['required', 'image']
        ]);

        $rutaImg = $datos["foto"]->store('Autores', 'public');

        Autores::create([
            'nombre'=>$datos["nombre"],
            'foto'=>$rutaImg,
            'biografia'=>$datos["biografia"]
        ]);
        return redirect('Autores')->with('AutorCreado', 'OK');
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autores  $autores
     * @return \Illuminate\Http\Response
     */
    public function show(Autores $autores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autores  $autores
     * @return \Illuminate\Http\Response
     */
    public function edit(Autores $autores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autores  $autores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autores $autores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autores  $autores
     * @return \Illuminate\Http\Response
     */
    public function delete($autor)
    {
        $autorFoto = Autores::find($autor);
        if(Storage::delete('public/'.$autorFoto->foto)){
            Autores::destroy($autor);

        }
        return redirect ('Autores');
    }

    public function AutorLibros($idAutor)
    {
        $autor = Autores::find($idAutor);
        $libros = Libro::all()->where('id_autor', $idAutor);

        return view('modulos.Autor-Libros', compact('autor','libros'));
    }
}
