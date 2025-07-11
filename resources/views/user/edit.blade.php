@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('styles')

    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/css/users.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container-fluid">
        <x-breadcrumb title="Editar usuario" />
        
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        </div>
        <div class="card modo-claro-forzado">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($user->es_superior)
                    <div class="alert alert-info">
                        Este usuario tiene acceso superior a todos los casos del sistema.
                    </div>
                @endif


                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                    class="modo-claro-forzado">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Checkbox es_superior --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="es_superior" id="es_superior"
                                    {{ old('es_superior', $user->es_superior) ? 'checked' : '' }}>
                                <label class="form-check-label" for="es_superior">
                                    Usuario con acceso superior (ver todos los casos)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="bloque_jerarquia">
                        {{-- Selección de padre --}}
                        <div class="col-md-6 mb-3" id="parent-container">
                            <label for="parent_id" class="form-label">Usuario Superior</label>
                            <select name="parent_id" id="parent_id" class="form-select">
                                <option value="">-- Ninguno --</option>
                                @foreach ($usuarios_superiores as $superior)
                                    <option value="{{ $superior->id }}"
                                        {{ old('parent_id', $user->parent_id) == $superior->id ? 'selected' : '' }}>
                                        {{ $superior->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="row">

                        {{-- Selección dinámica de familia(s) --}}
                        <div class="col-md-6 mb-3" id="bloque_familia"
                            style="{{ old('es_superior', $user->es_superior) ? 'display: none;' : '' }}">
                            <label for="familia_select" class="form-label">Familia(s)</label>
                            <select id="familia_select" class="form-select" name="familias[]" multiple>
                                @foreach ($familias as $familia)
                                    <option value="{{ $familia->id }}"
                                        {{ collect(old('familias', old('familia_id') ? [old('familia_id')] : $familiasAsignadas))->contains($familia->id) ? 'selected' : '' }}>
                                        {{ $familia->nombre }}
                                        ({{ $familia->ver_entre_hermanos ? '✓ puede ver entre hermanos' : '✗ no puede ver entre hermanos' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('familia_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            @error('familias')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre completo</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}">
                        </div>
                           <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address', $user->address) }}">
                        </div>

                    </div>
                    <div class="row">

                     

                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">Seleccione un rol</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->name }}"
                                        {{ old('role', $user->getRoleNames()->first()) == $rol->name ? 'selected' : '' }}>
                                        {{ ucfirst($rol->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="estatus" class="form-label">Estatus</label>
                            <select name="estatus" id="estatus" class="form-control">
                                <option value="activo" {{ old('estatus', $user->estatus) == 'activo' ? 'selected' : '' }}>
                                    Activo</option>
                                <option value="inactivo"
                                    {{ old('estatus', $user->estatus) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Nueva contraseña (opcional)</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Dejar en blanco para mantener la actual">
                        </div>


                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="mt-3">
                            <input type="file" name="photo" id="photo" data-plugins="dropify"
                                data-default-file="{{ $user->photo ? asset('storage/' . $user->photo) : '' }}" />
                            <p class="text-muted text-center mt-2 mb-0">Foto</p>
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
            <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Cerrar"></button>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('scripts')

    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>

    <script>
        const checkboxSuperior = document.getElementById('es_superior');
        const bloqueFamilia = document.getElementById('bloque_familia');
        const bloquePadre = document.getElementById('parent-container');
        const selectParent = document.getElementById('parent_id');
        const selectFamilias = document.getElementById('familia_select');

        function actualizarFamiliaDinamica() {
            const esSuperior = checkboxSuperior.checked;

            // Ocultar o mostrar bloques de jerarquía
            bloqueFamilia.style.display = esSuperior ? 'none' : 'block';
            bloquePadre.style.display = esSuperior ? 'none' : 'block';

            if (esSuperior) {
                // Limpiar valores si es superior
                selectParent.value = '';
                Array.from(selectFamilias.options).forEach(opt => opt.selected = false);
                return;
            }

            // Si NO es superior
            if (selectParent.value === '') {
                // No tiene padre → PADRE → múltiples familias
                selectFamilias.setAttribute('multiple', 'multiple');
                selectFamilias.name = 'familias[]';
            } else {
                // Tiene padre → HIJO → una sola familia
                selectFamilias.removeAttribute('multiple');
                selectFamilias.name = 'familia_id';

                // Si hay múltiples seleccionadas, dejar solo una
                const selected = Array.from(selectFamilias.selectedOptions);
                if (selected.length > 1) {
                    selected.forEach((opt, index) => opt.selected = index === 0);
                }
            }
        }

        checkboxSuperior.addEventListener('change', actualizarFamiliaDinamica);
        selectParent.addEventListener('change', actualizarFamiliaDinamica);
        document.addEventListener('DOMContentLoaded', actualizarFamiliaDinamica);
    </script>


@endsection
