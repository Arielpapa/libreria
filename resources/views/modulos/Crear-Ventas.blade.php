@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Crear Nueva Venta</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header">
                   <div class="col-md-4">
                       <h2>Seleccione el Cliente</h2>
                       <form method="post">
                           
                        @csrf

                           <select name="id_cliente" class="form-control input-lg" id="select2" required="">
                               <option value="">Seleccione...</option>
                               @foreach ($clientes as $cliente)
                               <option value="{{$cliente->id}}">{{$cliente->nombre}} - {{$cliente->documento}}</option>
                               @endforeach
                           </select>

                           <?php
                            date_default_timezone_set("America/Argentina/Buenos_Aires");
                            $time = time();
                            $hoy = date("d/m/y");
                            $hora = date("H:i", $time);

                           echo ' <input type="hidden" name="fecha" value="'.$hoy.' - '.$hora.'">';
                           ?>


                          

                           <br><br>

                           <button type="submit" class="btn btn-primary">Crear</button>
                       </form>
                   </div>
                   <div class="col-md-4">
                       <br><br><br>
                       <button class="btn btn-default" data-toggle="modal" data-target="#CrearCliente">Crear Nuevo Cliente</button>
                   </div>
                </div>
                <div class="box-body">

                    <table class="table table-bordered table-hover table-striped DT1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Fecha</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $venta)
                                <tr>
                                    <td>{{ $venta->id }}</td>
                                    <td>{{ $venta->CLIENTE->nombre }}</td>
                                    <td>{{ $venta->VENDEDOR->name }}</td>
                                    <td>{{ $venta->fecha }}</td>
                                    <td>
                                        <a href="{{ url('Venta/'.$venta->id)}}">
                                            <button class="btn btn-success">Gestionar Venta</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="CrearCliente">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <h2>Nombre:</h2>
                                <input type="text" class="form-control input-lg" name="nombre" required="">
                            </div>
                            <div class="form-group">
                                <h2>Documento:</h2>
                                <input type="text" class="form-control input-lg" name="documento" required="">
                            </div>
                            <div class="form-group">
                                <h2>Fecha de Nacimiento:</h2>
                                <input type="text" class="form-control input-lg" data-inputmask="'alias': 'dd/mm/yyyy'"  
                                data-mask name="fechaNac" required="">
                            </div>
                            <div class="form-group">
                                <h2>Direccion:</h2>
                                <input type="text" class="form-control input-lg" name="direccion" required="">
                            </div>
                            <div class="form-group">
                                <h2>Telefono:</h2>
                                <input type="text" class="form-control input-lg" data-inputmask="'mask': '(11) 9999-9999'"  
                                data-mask name="telefono" required="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Crear</button>
                        <button type="buttont" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection