<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Generos;
use App\Models\Autores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos = Generos::all();
        $autores = Autores::all();
        $libros = Libro::all();

        return view('modulos.Libro', compact('generos','autores','libros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $datos = request()->validate([
            'titulo'=>['required', 'string', 'max:255'],
            'sinopsis'=>['required', 'string'],
            'idioma'=>['required', 'string', 'max:255'],
            'fecha'=>['required'],
            'stock'=>['required'],
            'precio'=>['required'],
            'id_autor'=>['required'],
            'id_genero'=>['required'],
            'portada'=>['required', 'image']
        ]);

        $rutaImg = $datos["portada"]->store('Libros', 'public');

        Libro::create([
            'titulo'=>$datos["titulo"],
            'id_genero'=>$datos['id_genero'],
            'id_autor'=>$datos['id_autor'],
            'idioma'=>$datos['idioma'],
            'sinopsis'=>$datos['sinopsis'],
            'stock'=>$datos['stock'],
            'precio'=>$datos['precio'],
            'fecha'=>$datos['fecha'],
            'portada'=>$rutaImg
        ]);
        return redirect('Libros')->with('LibroCreado', 'OK');
    }

   
    public function show($libro)
    {
        $sinopsis = Libro::find($libro);

        $generos = Generos::all();
        $autores = Autores::all();
        $libros = Libro::all();


        return view('modulos.Libro', compact('sinopsis','generos','libros','autores'));
    }

  
    public function edit($libro)
    {
        $generos = Generos::all();
        $autores = Autores::all();
        $libros = Libro::all();

        $libroE = Libro::find($libro);

        
        return view('modulos.Libro', compact('libroE','generos','libros','autores'));
    }

    
    public function update(Request $request, $libro)
    {
        $datos = request()->validate([
            'titulo'=>['required', 'string', 'max:255'],
            'sinopsis'=>['required', 'string'],
            'idioma'=>['required', 'string', 'max:255'],
            'fecha'=>['required'],
            'stock'=>['required'],
            'precio'=>['required'],
            'id_autor'=>['required'],
            'id_genero'=>['required'],
            
        ]);
        $LIBRO = Libro::find($libro);

        $LIBRO->titulo = $datos["titulo"];
        $LIBRO->sinopsis = $datos["sinopsis"];
        $LIBRO->idioma = $datos["idioma"];
        $LIBRO->fecha = $datos["fecha"];
        $LIBRO->stock = $datos["stock"];
        $LIBRO->precio = $datos["precio"];
        $LIBRO->id_genero = $datos["id_genero"];
        $LIBRO->id_autor = $datos["id_autor"];

        if($request["portadaN"]){
            Storage::delete('public/'.$LIBRO->portada);
            $rutaImg = $request["portadaN"]->store('Libros', 'public');

            $LIBRO->portada = $rutaImg;
        }
        $LIBRO->save();
        return redirect('Libros');
    }

    
    public function destroy($libro)
    {
        $libroQ = Libro::find($libro);

        if(Storage::delete('public/'.$libroQ->portada)){
            Libro::destroy($libro);
        }
        return redirect('Libros');
    }
}
