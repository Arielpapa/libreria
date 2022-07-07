@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Gestionar el Pedido ID: {{$pedido->id}}</h1>

            <h4>Fecha de Envio: {{$pedido->fecha_envio}}</h4>
            <h4>Fecha de Entrega: {{$pedido->fecha_entrega}}</h4>

            @if ($pedido->estado == "Solicitado")
            <h3>Estado Actual: <button class="btn btn-primary">Solicitado</button>
            <br>
            <form action="{{ url('CambEstadoPed/'.$pedido->id) }}" method="POST">
                @csrf
                Cambiar a:  <button class="btn btn-warning" type="submit">En Camino</button>
            </h3>
            </form>

            @elseif ($pedido->estado == "En Camino")
            <h3>Estado Actual: <button class="btn btn-warning">En Camino</button>
            <br>

            <form action="{{ url('CambEstadoPed/'.$pedido->id) }}" method="POST">
                @csrf
                Cambiar a: <button class="btn btn-success" type="submit">Recibido</button>
            </h3>
            </form>
                
            @else
            <h3>Estado Actual: <button class="btn btn-success">Recibido</button>
                <br>

            @endif
        </section>
        <section class="content">
            <div class="box">
                <div class="box-body">
                    @if ($pedido->estado != 'Recibido')
                        <h2>Agregar Libros al Pedido</h2>

                        <h4>Registrados</h4>

                        <form action="" method="post">
                            @csrf
                            <div class="col-md-3">
                                <select name="id_libro" id="select2" required="">
                                    <option value="">Elegir...</option>
                                    @foreach ($libros as $libro)
                                        <option value="{{$libro->id}}">{{$libro->titulo}} - {{$libro->AUTOR->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <input type="number" class="form-control" name="cantidad" placeholder="Cantidad" min="1">
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar al Predido</button>

                        </form>
                        <hr>
                        
                    @endif

                    <table class="table table-hover table-bordered table-striped DT1">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Genero</th>
                                <th>Autor</th>
                                <th>Cantidad</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($librosP as $lp)
                                @foreach ($libros as $libro)
                                    @if ($lp->id_libro == $libro->id)
                                    <tr>
                                        <td>{{$libro->titulo}}</td>
                                        <td>{{$libro->GENERO->nombre}}</td>
                                        <td>{{$libro->AUTOR->nombre}}</td>
                                        <td>{{$lp->cantidad}}</td>

                                        @if ($pedido->estado != "Recibido")
                                        <td>
                                            <form action="{{url('LibroP-Quitar/'.$pedido->id)}}" method="POST">
                                                @csrf
                                                @method('delete')

                                                <input type="hidden" name="id" value="{{$lp->id}}">
                                                <input type="hidden" name="cantidad" value="{{$lp->cantidad}}">

                                                <button class="btn btn-danger" title="submit"><i class="fa fa-times"></i></button>
                                            </form>
                                        </td>

                                        @elseif($pedido->estado == "Recibido" && $lp->estado == "")
                                        <td>
                                            <form action="{{url('Verificar/'.$pedido->id)}}" method="POST">
                                                @csrf
                                                

                                                <input type="hidden" name="id_libro" value="{{$libro->id}}">
                                                <input type="hidden" name="cantidad" value="{{$lp->cantidad}}">
                                                <input type="hidden" name="lp_id" value="{{$lp->id}}">

                                                <button class="btn btn-success" title="submit"><i class="fa fa-check"></i></button>
                                            </form>
                                        </td>
                                     @else
                                     <td></td>

                                        @endif
                                        
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