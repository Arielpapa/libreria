@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Venta</h1>
            <div class="row">
                <div class="col-md-4">
                    <h3>Gestionar la Venta ID: {{ $venta->id }}</h3>

                    <h4>Vendedor: <b>{{ $vendedor->name }}</b></h4>
                    <h4>Cliente: <b>{{ $cliente->nombre }}</b></h4>
                    <h4>Fecha: <b>{{ $venta->fecha }}</b></h4>
                    <h4>Total: <b> ${{ number_format($precio, 2)  }}</b></h4>

                </div>

                
                
            </div>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <table class="table table-borderer table-hover table-striped DT1">
                        <thead>
                            <tr>
                                <th>Libro</th>
                                <th>Autor</th>
                                <th>Portada</th>
                                <th>Precio</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($librosVenta as $LV)

                            @foreach ($libros as $L)

                            @if ($L->id == $LV->id_libro)
                                <tr>
                                    <td>{{$L->titulo}}</td>
                                    <td>{{$L->AUTOR->nombre}}</td>
                                    <td><img src="{{ url('storage/'.$L->portada) }}" width="50px" height="50px"></td>
                                    <td>{{$L->precio}}</td>
                                  
                                </tr>
                            @endif
                                
                            @endforeach
                                
                            @endforeach
                        </tbody>
                    </table>   
                </div>
            </div>
        </section>
    </div>
@endsection