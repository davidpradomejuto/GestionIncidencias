<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
</div>
@extends('layouts.plantilla')
@section('titulo', 'Nuevo Usuario')
@section('contenido')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar usuario</li>
        </ol>
    </nav>
    <h1>Editar usuario</h1>


    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Hubo errores en el formulario:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container" id="caja-formulario">

            <form action="{{ route('usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="nombreCompleto" class="form-label">Nombre completo:</label>
                    <input type="text" id="nombreCompleto" name="nombreCompleto" class="form-control readonly-custom"
                        readonly value="{{ $usuario->nombre_completo }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">email:</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{ $usuario->email }}">
                </div>
                {{-- Si el usuario ya tiene un departamento no le dejo editarlo --}}
                @if (@empty($usuario->departamento->nombre) || auth()->user()->hasRole('Administrador'))

                    <div class="mb-3">
                        <label for="departamento_id" class="form-label">Departamentos</label>
                        <select id="departamento_id" name="departamento_id" class="form-select">
                            <option selected>...</option>

                            @foreach ($departamentos as $departamento)
                                @if (!@empty($usuario->departamento->nombre) && $departamento->nombre == $usuario->departamento->nombre)
                                    <option value="{{ $departamento->id }}" selected>{{ $departamento->nombre }}</option>
                                @else
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>


                @endif

                @hasrole('Administrador')
                    <div class="mb-3">
                        <label for="rol_id" class="form-label">Roles</label>
                        <select id="rol_id" name="rol_id" class="form-select">
                            @if ($usuario->getRol() == 'Administrador')
                                <option value="2"> Administrador</option>
                                <option value="1"> Profesor</option>
                            @else
                                <option value="1"> Profesor</option>
                                <option value="2"> Administrador</option>
                            @endif

                        </select>
                    </div>
                @endhasrole
                <div class="d-flex justify-content-center mt-3">
                    <input type="submit" id="crear "class="btn btn-outline-primary col-sm-2" value="Editar usuario">
                </div>
                <script>
                    document.querySelector('#formulario1').addEventListener('submit', function(e) {
                        var form = this;

                        e.preventDefault();

                        swal({
                            title: "GUARDAR CAMBIOS",
                            text: "¿Quieres guardar los cambios en el usuario?",
                            icon: "warning",
                            buttons: [
                                'No, cancelar',
                                'Si, Estoy Seguro'
                            ],
                            dangerMode: true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                swal({
                                    title: '¡HECHO!',
                                    text: 'El usuario ha sido editado',
                                    icon: 'success'
                                }).then(function() {
                                    form.submit();
                                });
                            } else {
                                swal("Cancelado", "El usuario no ha sido editado", "error");
                            }
                        });
                    });
                </script>
            </form>

        @endsection
