@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('styles')

    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" />

@endsection

@section('content')
<div class="container-fluid">
       <x-breadcrumb title="Editar usuario" />
    <div class="row mx-4">
        <div class="col-12">
            <h4 class="mb-3">Editar Usuario</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre completo</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="role_id" class="form-label">Rol</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="">Seleccione un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ old('role_id', $user->role_id) == $rol->id ? 'selected' : '' }}>
                                    {{ $rol->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="estatus" class="form-label">Estatus</label>
                        <select name="estatus" id="estatus" class="form-control">
                            <option value="activo" {{ old('estatus', $user->estatus) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('estatus', $user->estatus) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Nueva contraseña (opcional)</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Dejar en blanco para mantener la actual">
                    </div>

           
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="mt-3">
                            <input type="file" name="photo" id="photo" data-plugins="dropify"
                                data-default-file="{{ asset('storage/' . $user->photo) }}" />
                            <p class="text-muted text-center mt-2 mb-0">Foto</p>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
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
