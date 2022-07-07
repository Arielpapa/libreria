@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Generos</h1>
            <br>
            <form method="post">

                @csrf

                <div class="col-md-3 col-xs-12">
                    <input type="text" class="form-control" name="nombre"
                    placeholder="Ingrese un nuevo genero" required>
                </div>
                <button class="btn btn-primary" type="submit">Agregar</button>
            </form>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    
                        
                        @foreach ($generos as $genero)
                        <div class="row">
                        <form method="post" action="{{url ('Actualizar-Genero/'.$genero->id)}}">

                            @csrf
                            @method('put')

                            <div class="col-md-3">
                                <input type="text" class="form-control" name="nombre" value="{{$genero->nombre}}">
                            </div>

                            <div class="col-mb-3">
                                <a href="{{ url('Genero-Libros/'.$genero->id) }}">
                                    <button class="btn btn-primary" type="button">Ver Libros</button>
                                </a>
                                
                              

                                <button class="btn btn-success" type="submit"><i class="fa fa-pencil"></i></button>

                               <a href="{{ url('Eliminar-Genero/'.$genero->id) }}">
                                <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button>
                               </a>

                            </div>
                        </form>
                    </div>
                    <br>
                        @endforeach

                    
                </div>
            </div>
        </section>
    </div>
@endsection