<?php

namespace App\Http\Controllers;

use App\Models\Generos;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenerosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos = Generos::all();

        return view('modulos.Generos')->with( 'generos', $generos);
    }

    
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = request();

        DB::table('generos')->insert(['nombre'=>$datos['nombre']]);

        return redirect('Generos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Generos  $generos
     * @return \Illuminate\Http\Response
     */
    public function show(Generos $generos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Generos  $generos
     * @return \Illuminate\Http\Response
     */
    public function edit(Generos $generos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Generos  $generos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Generos $genero)
    {
        $genero = Generos::find($genero->id);

        $genero->nombre = request('nombre');
        
        $genero->save();

        return redirect ('Generos');
    }

  
    public function destroy($id)
    {
        DB::table('generos')->whereId($id)->delete();

        return redirect('Generos');
    }

    public function GeneroLibros($idGenero){
        $genero = Generos::find($idGenero);
        $libros =Libro::all()->where('id_genero',$idGenero);

        return view('modulos.Genero-Libros',compact('genero','libros'));
    }
}
