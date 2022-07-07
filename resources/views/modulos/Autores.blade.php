@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Autores</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <a href="{{ url('Agregar-Autor') }}">

                        <button class="btn btn-primary">Agregar Autor</button>

                    </a>
                    <br>
                    <br>
                    <table class="table table-bordered table-hover table-striped DT1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Autor</th>
                                <th>Biografia</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($autores as $autor)
                                <tr>
                                    <td>{{ $autor->id}}</td>
                                    <td><img src="{{url('storage/'.$autor->foto)}}"  height="50px" width="50px"></td>
                                    <td>{{ $autor->nombre}}</td>
                                    <td>{{ $autor->biografia}}</td>

                                    <td>
                                        <a href="{{url('Autor-Libros/'.$autor->id)}}">
                                            <button class="btn btn-primary">Libros</button>
                                        </a>

                                        <form method="post" action="{{url('Quitar-Autor/'.$autor->id)}}">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger">Quitar</button>

                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection