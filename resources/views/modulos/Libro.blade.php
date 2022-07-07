@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Gestor de Libros</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#agregarLibro">Agregar Libro</button>
                </div>
                <div class="box-body">

                    <table class="table table-borderer table-hover table-striped DT1">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Genero</th>
                                <th>Autor</th>
                                <th>Sinopsis</th>
                                <th>Idioma</th>
                                <th>Portada</th>
                                <th>Fecha de Publicacion</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($libros as $libro)
                            <tr>
                                <td>{{$libro->titulo}}</td>

                                <td>{{$libro->GENERO->nombre}}</td>
                                <td>{{$libro->AUTOR->nombre}}</td>

                                <td>{{ Str::limit($libro->sinopsis,150) }} <a href="{{ url ('Libro-S/'.$libro->id)}}">
                                    <button class="btn btn-danger btn-xs">Leer</button>
                                    </a>
                                </td>
                                <td>{{$libro->idioma}}</td>
                                <td><img src="{{url('storage/'.$libro->portada)}}" width="50px"></td>
                                <td>{{$libro->fecha}}</td>

                                @if ($libro->stock < 10 && $libro->stock > 5)
                                <td><button class="btn btn-warning">{{$libro->stock}}</button></td>
                                @elseif($libro->stock <= 5)
                                <td><button class="btn btn-danger">{{$libro->stock}}</button></td>
                                @else
                                <td><button class="btn btn-success">{{$libro->stock}}</button></td>
                                @endif

                              
                                <td> ${{$libro->precio}}</td>
                                <td>
                                    <a href="{{ url('Libro-E/'.$libro->id)}}">
                                        <button class="btn btn-success"><i class="fa fa-pencil"></i> Editar</button>
                                    </a>

                                    <button class="btn btn-danger QuitarLibro" Lid="{{$libro->id}}"><i class="fa fa-trash"></i> Eliminar</button>

                                </td>
                               
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </section>
    </div>


    <div class="modal fade" id="agregarLibro">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <h2>Titulo</h2>
                                <input type="text" class="form-control input-lg" name="titulo" required="">
                            </div>
                            <div class="form-group">
                                <h2>Genero</h2>
                                <select name="id_genero" class="form-control input-lg" required="">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($generos as $genero)
                                    <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <h2>Autor</h2>
                                <select name="id_autor" class="form-control input-lg" required="">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($autores as $autor)
                                    <option value="{{$autor->id}}">{{$autor->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <h2>Sinopsis</h2>
                                <textarea name="sinopsis" class="form-control" style="height: 100px" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <h2>Idioma</h2>
                                <input type="text" class="form-control input-lg" name="idioma" required="">
                            </div>
                            <div class="form-group">
                                <h2>Portada</h2>
                                <input type="file" class="form-control input-lg" name="portada" required="">
                            </div>
                            <div class="form-group">
                                <h2>Fecha de Publicacion</h2>
                                <input type="text" class="form-control input-lg" name="fecha" 
                                data-inputmask="'alias':'dd/mm/yyyy'" data-mask required="">
                            </div>
                            <div class="form-group">
                                <h2>Stock</h2>
                                <input type="number" class="form-control input-lg" name="stock" required="">
                            </div>
                            <div class="form-group">
                                <h2>Precio</h2>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control input-lg" name="precio" required="">
                                </div>
                                
                            </div>



                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Agregar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

<?php
  $exp = explode("/", $_SERVER["REQUEST_URI"]);

?>    

@if ($exp[1] == "Libro-S" )
    

    {{-- otro modal --}}
    <div class="modal face" id="Sinopsis">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Sinopsis</h2>
                    <p>{{$sinopsis->sinopsis}}</p>
                </div>
                <div class="modal-footer">
                    {{-- <button class="btn btn-danger" data-dismiss="modal">Cerrar</button> --}}
                    <a href="{{ url ('Libros')}}">
                        <button class="btn btn-danger" >Cerrar</button>
                        </a>
                </div>
            </div>
        </div>
    </div>


    @elseif($exp[1] == "Libro-E")
    <div class="modal fade" id="EditarLibro">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" action="{{url ('Libro-A/'.$libroE->id)}}"> 
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <h2>Titulo</h2>
                                <input type="text" class="form-control input-lg" name="titulo" required=""
                                value="{{$libroE->titulo}}">
                            </div>
                            <div class="form-group">
                                <h2>Genero</h2>
                                <select name="id_genero" class="form-control input-lg" required="">
                                    <option value="{{$libroE->id_genero}}">{{$libroE->GENERO->nombre}}</option>
                                    @foreach ($generos as $genero)
                                    <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <h2>Autor</h2>
                                <select name="id_autor" class="form-control input-lg" required="">
                                    <option value="{{$libroE->id_autor}}">{{$libroE->AUTOR->nombre}}</option>
                                    @foreach ($autores as $autor)
                                    <option value="{{$autor->id}}">{{$autor->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <h2>Sinopsis</h2>
                                <textarea name="sinopsis" class="form-control" style="height: 100px" required="">
                                    {{$libroE->sinopsis}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <h2>Idioma</h2>
                                <input type="text" class="form-control input-lg" name="idioma" required=""
                                value="{{$libroE->idioma}}">
                            </div>

                            <div class="form-group">
                                <h2>Portada</h2>
                                <input type="file" class="form-control input-lg" name="portadaN">
                                <img src="{{url('storage/'.$libroE->portada)}}" width="300px">
                            </div>

                            <div class="form-group">
                                <h2>Fecha de Publicacion</h2>
                                <input type="text" class="form-control input-lg" name="fecha" 
                                data-inputmask="'alias':'dd/mm/yyyy'" data-mask required=""
                                value="{{$libroE->fecha}}">
                            </div>
                            <div class="form-group">
                                <h2>Stock</h2>
                                <input type="number" class="form-control input-lg" name="stock" required=""
                                value="{{$libroE->stock}}">
                            </div>
                            <div class="form-group">
                                <h2>Precio</h2>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control input-lg" name="precio" required=""
                                    value="{{$libroE->precio}}">
                                </div>
                                
                            </div>



                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Guardar Cambios</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @endif



@endsection