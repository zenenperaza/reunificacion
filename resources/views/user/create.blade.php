@extends('layouts.app')

@section('title', 'Mantenimiento de Usuarios')

@section('content')
<div class="container-fluid">
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

            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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

                    <div class="col-md-6 mb-3">
                        <label>Foto</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-content-save"></i> Guardar Usuario
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
