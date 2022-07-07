@extends('plantilla')

@section('contenido')

<div class="content-wrapper">

    <section class="content-header">

        <h1>Gestión de Usuarios</h1>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header">

                <button class="btn btn-primary" data-toggle="modal" data-target="#CrearUsuario">Crear Nuevo Usuario</button>

            </div>

            <div class="box-body">

               <table class="table table-bordered table-hover table-striped tabla1">
               
                    <thead>

                        <tr>

                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Foto</th>
                            <th>Opciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($usuarios as $user)

                            <tr>

                                <td>{{ $user->name }}</td>

                                @if($user->documentos == "")

                                    <td>No registrado</td>

                                @else

                                    <td>{{ $user->documento }}</td>

                                @endif

                                <td>{{ $user->email }}</td>
                                <td>{{ $user->rol }}</td>

                                @if($user->foto == "")

                                    <td><img src="{{ url('storage/defecto.png') }}" width="50px"></td>

                                @else

                                    <td><img src="{{ url('storage/'.$user->foto) }}" width="50px"></td>

                                @endif

                                <td>

                                    <a href="{{ url('Editar-Usuario/'.$user->id) }}">
                                        <button class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                    </a>
                                    
                                    <button class="btn btn-danger EliminarUsuario" Uid="{{ $user->id }}" Usuario="{{ $user->name }}"><i class="fa fa-trash"></i></button>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table> 

            </div>

        </div>
        
    </section>

</div>

<div class="modal fade" id="CrearUsuario">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post">

                @csrf

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <h4>Rol de Usuario:</h4>

                            <select class="form-control input-lg" name="rol" required="">

                                <option value="">Seleccionar:</option>

                                <option value="Administrador">Administrador</option>
                                <option value="Vendedor">Usuario</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <h4>Nombre:</h4>
                            <input type="text" class="form-control input-lg" name="name" required="" value="{{ old('name') }}">

                        </div>

                        <div class="form-group">

                            <h4>Email:</h4>
                            <input type="email" class="form-control input-lg" name="email" required="">

                            @error('email')

                                <br>
                                <div class="alert alert-danger">El Email ya existe</div>

                            @enderror

                        </div>

                        <div class="form-group">

                            <h4>Contraseña:</h4>
                            <input type="text" class="form-control input-lg" name="password" required="">

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                </div>

            </form>

        </div>

    </div>

</div>


<?php 
$exp = explode('/', $_SERVER["REQUEST_URI"]);
?>
@if ($exp[1] == 'Editar-Usuario')

<div class="modal fade" id="EditarUsuario">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" action="{{ url('actualizar-Usuario/'.$user->id)}}">

                @csrf
                @method('put')

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <h4>Rol de Usuario:</h4>

                            <select class="form-control input-lg" name="rol" required="">

                                <option value="{{$usuario->rol}}">{{$usuario->rol}}</option>

                                <option value="Administrador">Administrador</option>
                                <option value="Vendedor">Usuario</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <h4>Nombre:</h4>
                            <input type="text" class="form-control input-lg" name="name" required=""
                             value="{{$usuario->name }}">

                        </div>

                        <div class="form-group">

                            <h4>Email:</h4>
                            <input type="email" class="form-control input-lg" name="email" required=""
                            value="{{$usuario->email}}">

                            @error('email')

                                <br>
                                <div class="alert alert-danger">El Email ya existe</div>

                            @enderror

                        </div>

                        <div class="form-group">

                            <h4>Contraseña:</h4>
                            <input type="text" class="form-control input-lg" name="password" >

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                </div>

            </form>

        </div>

    </div>

</div>
@endif
@endsection