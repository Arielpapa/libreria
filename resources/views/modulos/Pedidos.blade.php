@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Gestor de Pedidos</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <div class="col-md-6">
                        <form method="post" action="{{ url('Pedidos')}}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <h2>Fecha de Envio:</h2>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="fecha_envio" class="form-control pull-right date1" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h2>Fecha de Entrega:</h2>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="fecha_entrega" class="form-control pull-right date1" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                     
                    </div>

                    <div class="col-md-4">
                        <br><br><br>

                        <button class="btn btn-primary" type="submit">Crear Nuevo pedido</button>
                    </div>
                </form>
                </div>
                <div class="box-body">
                    <a href="{{ url('Pedidos') }}">
                        <button class="btn btn-default">Todos</button>
                    </a>
                    <a href="{{ url('Pedidos-Solicitados') }}">
                        <button class="btn btn-primary">Solicitados</button>
                    </a>
                    <a href="{{ url('Pedidos-EnCamino') }}">
                        <button class="btn btn-warning">En Camino</button>
                    </a>
                    <a href="{{ url('Pedidos-Recibidos') }}">
                        <button class="btn btn-success">Recibidos</button>
                    </a>
                    <br><br>

                    <table class="table table-bordered table-hover table-striped DT1">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cantidad de Libros</th>
                                <th>Fecha de Envio</th>
                                <th>Fecha de ENtrega</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php 
                            $exp = explode('/', $_SERVER["REQUEST_URI"]);
                        ?>
                        <tbody>
                            @foreach ($pedidos as $pedido)

                                @if ($exp[1] == "Pedidos")
                                <tr>
                                    <td>{{$pedido->id}}</td>
                                    <td>{{$pedido->cantidad}}</td>
                                    <td>{{$pedido->fecha_envio}}</td>
                                    <td>{{$pedido->fecha_entrega}}</td>

                                    @if ($pedido->estado == 'Solicitado')
                                     <td> <button class="btn btn-primary">{{$pedido->estado}}</button></td>

                                    @elseif($pedido->estado == 'En Camino')
                                     <td> <button class="btn btn-warning">{{$pedido->estado}}</button></td>

                                    @else
                                    <td> <button class="btn btn-success">{{$pedido->estado}}</button></td>
                                    @endif

                                    
                                    <td>
                                        <a href="{{ url('Gestionar-Pedido/'.$pedido->id)}}">
                                            <button class="btn btn-default">Gestionar</button>
                                        </a>
                                    </td>
                                </tr>

                                @elseif($exp[1]== "Pedidos-Solicitados")

                                    @if($pedido->estado == "Solicitado")

                                        <tr>
                                            <td>{{$pedido->id}}</td>
                                            <td>{{$pedido->cantidad}}</td>
                                            <td>{{$pedido->fecha_envio}}</td>
                                            <td>{{$pedido->fecha_entrega}}</td>
                                            <td> <button class="btn btn-primary">{{$pedido->estado}}</button></td>
                                            <td>
                                                <a href="{{ url('Gestionar-Pedido/'.$pedido->id)}}">
                                                    <button class="btn btn-default">Gestionar</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif    

                                @elseif($exp[1]== "Pedidos-EnCamino")
                                     @if($pedido->estado == "En Camino")

                                        <tr>
                                            <td>{{$pedido->id}}</td>
                                            <td>{{$pedido->cantidad}}</td>
                                            <td>{{$pedido->fecha_envio}}</td>
                                            <td>{{$pedido->fecha_entrega}}</td>
                                            <td> <button class="btn btn-warning">{{$pedido->estado}}</button></td>
                                            <td>
                                                <a href="{{ url('Gestionar-Pedido/'.$pedido->id)}}">
                                                    <button class="btn btn-default">Gestionar</button>
                                                </a>
                                            </td>
                                        </tr>
                                     @endif    
                                @else
                                    @if($pedido->estado == "Recibido")

                                        <tr>
                                            <td>{{$pedido->id}}</td>
                                            <td>{{$pedido->cantidad}}</td>
                                            <td>{{$pedido->fecha_envio}}</td>
                                            <td>{{$pedido->fecha_entrega}}</td>
                                            <td> <button class="btn btn-success">{{$pedido->estado}}</button></td>
                                            <td>
                                                <a href="{{ url('Gestionar-Pedido/'.$pedido->id)}}">
                                                    <button class="btn btn-default">Gestionar</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif    

                                @endif



                               
                           
                               
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
{{-- 

@if ($exp[3] == "Pedidos")   
<tr>
    <td>{{$pedido->id}}</td>
    <td>{{$pedido->cantidad}}</td>
    <td>{{$pedido->fecha_envio}}</td>
    <td>{{$pedido->fecha_entrega}}</td>

    @if ($pedido->estado == 'Solicitado')
        <td><button class="btn btn-primary">{{$pedido->estado}}</button></td>
   
    @elseif($pedido->estado == 'En Camino')
        <td><button class="btn btn-warning">{{$pedido->estado}}</button></td>
    
    @else
        <td><button class="btn btn-success">{{$pedido->estado}}</button></td>
    @endif
    

    <td>
        <a href="{{ url('Gestionar-Pedido/'.$pedido->id) }}">
            <button class="btn btn-default">Gestionar</button>
        </a>
    </td>
</tr>

@elseif($exp[3] == "Pedidos-Solicitado")

    @if($pedido->estado=="Solicitado")
    <tr>
        <td>{{$pedido->id}}</td>
        <td>{{$pedido->cantidad}}</td>
        <td>{{$pedido->fecha_envio}}</td>
        <td>{{$pedido->fecha_entrega}}</td>
            <td><button class="btn btn-primary">{{$pedido->estado}}</button></td>
        <td>
            <a href="{{ url('Gestionar-Pedido/'.$pedido->id) }}">
                <button class="btn btn-default">Gestionar</button>
            </a>
        </td>
    </tr>
    @endif

@else
@if ($exp[3] == "En Camino")   
<tr>
    <td>{{$pedido->id}}</td>
    <td>{{$pedido->cantidad}}</td>
    <td>{{$pedido->fecha_envio}}</td>
    <td>{{$pedido->fecha_entrega}}</td>
        <td><button class="btn btn-warning">{{$pedido->estado}}</button></td>
    <td>
        <a href="{{ url('Gestionar-Pedido/'.$pedido->id) }}">
            <button class="btn btn-default">Gestionar</button>
        </a>
    </td>
</tr>

@elseif($exp[3] == "Pedidos-Solicitado")

    @if($pedido->estado=="Solicitado")
    <tr>
        <td>{{$pedido->id}}</td>
        <td>{{$pedido->cantidad}}</td>
        <td>{{$pedido->fecha_envio}}</td>
        <td>{{$pedido->fecha_entrega}}</td>
            <td><button class="btn btn-primary">{{$pedido->estado}}</button></td>
        <td>
            <a href="{{ url('Gestionar-Pedido/'.$pedido->id) }}">
                <button class="btn btn-default">Gestionar</button>
            </a>
        </td>
    </tr>
    @endif

@endif --}}