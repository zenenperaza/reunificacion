@extends('layouts.app')

@section('title', 'Mantenimiento de Usuarios')

@section('styles')

    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" />

@endsection

@section('content')
<div class="container-fluid">
       <x-breadcrumb title="Crear usuario" />
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a la lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Registrar Nuevo Usuario</h4>

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data"  id="userForm">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nombre completo</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Teléfono</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Dirección</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Rol</label>
                        <select name="role_id" class="form-select" required>
                            <option value="">Seleccione un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('role_id') == $rol->id ? 'selected' : '' }}>
                                    {{ $rol->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Estatus</label>
                        <select name="estatus" class="form-select" required>
                            <option value="activo" {{ old('estatus') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estatus') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                  
                   <div class="col-lg-4">
                        <div class="mt-3">
                            <input type="file" name="photo" id="photo" data-plugins="dropify"
                                data-default-file="{{ asset('assets/images/small/default.png') }}" />
                            <p class="text-muted text-center mt-2 mb-0">Foto</p>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-content-save"></i> Guardar Usuario
                </button>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')

    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>

@endsection



