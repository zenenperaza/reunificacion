@extends('layouts.app')

@section('title', 'Configuración del Sistema')

@section('content')
    <div class="container-fluid mx-2">
        <x-breadcrumb title="Configuración del Sistema" icono="<i class='fe-settings noti-icon'></i>" />

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('configuraciones.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Cambiar Fecha actual en Casos?</label>
                            <select name="conf_fecha_actual" class="form-control" required>
                                <option value="si" {{ $config->conf_fecha_actual === 'si' ? 'selected' : '' }}>Sí
                                </option>
                                <option value="no" {{ $config->conf_fecha_actual === 'no' ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">¿Sistema deshabilitado?</label>
                            <select name="sistema_deshabilitado" class="form-control" required>
                                <option value="si" {{ $config->sistema_deshabilitado === 'si' ? 'selected' : '' }}>Sí
                                </option>
                                <option value="no" {{ $config->sistema_deshabilitado === 'no' ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Periodo actual</label>
                            <input type="month" name="periodo" class="form-control" value="{{ $config->periodo }}"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Nombre del sistema</label>
                            <input type="text" name="nombre_sistema" class="form-control"
                                value="{{ $config->nombre_sistema }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo actual:</label><br>
                        @if ($config->logo_sistema)
                            <img src="{{ Storage::url($config->logo_sistema) }}" height="60" alt="Logo actual">
                        @else
                            <p class="text-muted">No hay logo cargado.</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nuevo logo del sistema</label>
                        <input type="file" name="logo_sistema" class="form-control">
                        <small class="form-text text-muted">Formatos permitidos: jpg, jpeg, png, webp. Tamaño máximo:
                            2MB.</small>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Texto del encabezado público</label>
                            <textarea name="texto_portada" rows="4" class="form-control">{{ old('texto_portada', $config->texto_portada) }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagen actual de portada:</label><br>
                        @if ($config->imagen_portada)
                            <img src="{{ Storage::url($config->imagen_portada) }}" alt="Imagen portada"
                                class="img-thumbnail" style="max-height: 180px;">
                        @else
                            <p class="text-muted">No hay imagen de portada cargada.</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nueva imagen de portada</label>
                        <input type="file" name="imagen_portada" class="form-control">
                        <small class="form-text text-muted">Formatos permitidos: jpg, jpeg, png, webp. Tamaño máximo:
                            2MB.</small>
                    </div>


                    <button type="submit" class="btn btn-primary">Guardar configuración</button>
                </form>
            </div>
        </div>
    </div>
@endsection
