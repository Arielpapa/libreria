
@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Clientes</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#CrearCliente">Crear Cliente</button>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-hover DT1">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->nombre}}</td>
                                    <td>{{$cliente->documento}}</td>
                                    <td>{{$cliente->fechaNac}}</td>
                                    <td>{{$cliente->direccion}}</td>
                                    <td>{{$cliente->telefono}}</td>

                                    <td>

                                        <a href="{{url('Editar-Cliente/'.$cliente->id)}}" >
                                            <button class="btn btn-success">
                                                <i class="fa fa-pencil"></i></button>
                                        </a>


                                       
                                        <button class="btn btn-danger EliminarCliente" Cid="{{$cliente->id}}"
                                        Cliente="{{$cliente->nombre}}">
                                            <i class="fa fa-trash"></i></button>
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

    <?php 
    $exp = explode('/', $_SERVER["REQUEST_URI"]);
    ?>
    @if ($exp[1] == 'Editar-Cliente')
        
    <div class="modal fade" id="EditarCliente">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{url('actualizarC/'.$cli->id)}}">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <h2>Nombre:</h2>
                                <input type="text" class="form-control input-lg" name="nombre" required=""
                                value="{{$cli->nombre}}">
                            </div>
                            <div class="form-group">
                                <h2>Documento:</h2>
                                <input type="text" class="form-control input-lg" name="documento" required=""
                                value="{{$cli->documento}}">
                            </div>
                            <div class="form-group">
                                <h2>Fecha de Nacimiento:</h2>
                                <input type="text" class="form-control input-lg" data-inputmask="'alias': 'dd/mm/yyyy'"  
                                data-mask name="fechaNac" required=""  value="{{$cli->fechaNac}}">
                            </div>
                            <div class="form-group">
                                <h2>Direccion:</h2>
                                <input type="text" class="form-control input-lg" name="direccion" required=""
                                value="{{$cli->direccion}}">
                            </div>
                            <div class="form-group">
                                <h2>Telefono:</h2>
                                <input type="text" class="form-control input-lg" data-inputmask="'mask': '(11) 9999-9999'"  
                                data-mask name="telefono" required=""  value="{{$cli->telefono}}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <button type="buttont" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection