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

                    <br>
                    <form method="POST" action="{{ url('FinalizarVenta') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$venta->id}}">
                        <input type="hidden" name="total" value="{{$precio}}">

                        <button type="submit" class="btn btn-success">Finalizar Venta</button>
                    </form>

                </div>

                <div class="col-md-8 bg-success" >
                    {{-- <table class="table table-borderer table-hover table-striped DT1"> --}}
                    <table class="table table-hover table striped table-bordered DT2">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Genero</th>
                                <th>Autor</th>
                                <th>Portada</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($libros as $libro)
                            @if ($libro->stock > 0 )
                                <tr>
                                    <td>{{$libro->titulo}}</td>
                                    <td>{{$libro->GENERO->nombre}}</td>
                                    <td>{{$libro->AUTOR->nombre}}</td>
                                    <td><img src="{{ url('storage/'.$libro->portada) }}" width="50px" height="50px"></td>
                                    @if ($libro->stock < 10 && $libro->stock > 5)
                                    <td><button class="btn btn-warning">{{$libro->stock}}</button></td>
                                    @elseif($libro->stock <= 5)
                                    <td><button class="btn btn-danger">{{$libro->stock}}</button></td>
                                    @else
                                    <td><button class="btn btn-success">{{$libro->stock}}</button></td>
                                    @endif
                                    <td>$ {{$libro->precio}}</td>
                                    <td>
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" name="id_venta" value="{{$venta->id}}">
                                            <input type="hidden" name="id_libro" value="{{$libro->id}}">
                                            <input type="hidden" name="precio" value="{{$libro->precio}}">
                                            <input type="hidden" name="stock" value="{{$libro->stock}}">
                                            <button class="btn btn-success" type="submit">Agregar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                                
                            @endforeach
                        </tbody>
                    </table>
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
                                <th>
                                    
                                </th>
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
                                    <td>
                                        <form method="post" action="{{ url('Quitar-Libro-Venta/'.$venta->id)}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$LV->id}}">
                                            <input type="hidden"  name="id_libro" value="{{$L->id}}">
                                            <input type="hidden"  name="stock" value="{{$L->stock}}">

                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
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