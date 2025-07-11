@extends('layouts.app')

@section('title', 'Mantenimiento de Usuarios')

@section('styles')

    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/css/users.css') }}" rel="stylesheet">

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

        <div class="card modo-claro-forzado">
            <div class="card-body">
                <h4 class="header-title mb-4">Registrar Nuevo Usuario</h4>

                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" id="userForm">
                    @csrf

                    <div class="mb-3">
                        <label for="es_superior" class="form-label">
                            <input type="checkbox" id="es_superior" name="es_superior" value="1"
                                {{ old('es_superior') ? 'checked' : '' }}>
                            Es superior (ver todos los casos)
                        </label>
                    </div>

                    <div id="bloque_familia" style="{{ old('es_superior') ? 'display: none;' : '' }}">
                        {{-- Selección de Padre --}}
                        <div class="mb-3" id="parent-container">
                            <label for="parent_id" class="form-label">Usuario Padre</label>
                            <select name="parent_id" id="parent_id" class="form-select">
                                <option value="">-- Sin padre (será Padre principal) --</option>
                                @foreach ($usuarios_superiores as $u)
                                    <option value="{{ $u->id }}" {{ old('parent_id') == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }} ({{ $u->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Selector único para familias (dinámico) --}}
                        <div class="mb-3" id="bloque_familias_dinamico">
                            <label for="familia_select" class="form-label">Familia(s)</label>
                            <select id="familia_select" class="form-select" name="familias[]" multiple>
                                @foreach ($familias as $familia)
                                    <option value="{{ $familia->id }}"
                                        {{ collect(old('familias', (array) old('familia_id')))->contains($familia->id) ? 'selected' : '' }}>
                                        {{ $familia->nombre }}
                                        ({{ $familia->ver_entre_hermanos ? '✓ puede ver entre hermanos' : '✗ no puede ver entre hermanos' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    {{-- <div class="col-md-6 mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="ver_entre_hermanos"
                                name="ver_entre_hermanos" {{ old('ver_entre_hermanos') ? 'checked' : '' }}>
                            <label class="form-check-label" for="ver_entre_hermanos">¿Puede ver casos de hermanos?</label>
                        </div> --}}



                    <div class="row">



                        <div class="col-md-6 mb-3">
                            <label>Nombre completo</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Teléfono</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Dirección</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Rol</label>
                            <select name="role" class="form-select" required>
                                <option value="">Seleccione un rol</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->name }}" {{ old('role') == $rol->name ? 'selected' : '' }}>
                                        {{ ucfirst($rol->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Estatus</label>
                            <select name="estatus" class="form-select" required>
                                <option value="activo" {{ old('estatus') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estatus') == 'inactivo' ? 'selected' : '' }}>Inactivo
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="row">

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
        function toggleParentField() {
            const isSuperior = document.getElementById('es_superior').checked;
            const parentContainer = document.getElementById('parent-container');

            if (isSuperior) {
                parentContainer.style.display = 'none';
                parentContainer.querySelector('select').value = '';
            } else {
                parentContainer.style.display = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleParentField();
            document.getElementById('es_superior').addEventListener('change', toggleParentField);
        });
    </script>

    <script>
        const checkboxSuperior = document.getElementById('es_superior');
        const bloqueFamilia = document.getElementById('bloque_familia');
        const parentContainer = document.getElementById('parent-container');
        const selectParent = document.getElementById('parent_id');
        const selectFamilias = document.getElementById('familia_select');

        function actualizarFamiliaDinamica() {
            const esSuperior = checkboxSuperior.checked;
            const parentId = selectParent.value;

            // Mostrar u ocultar campos según "es_superior"
            bloqueFamilia.style.display = esSuperior ? 'none' : 'block';
            parentContainer.style.display = esSuperior ? 'none' : 'block';

            if (esSuperior) {
                selectFamilias.innerHTML = '';
                return;
            }

            if (parentId === '') {
                // PADRE → mostrar todas las familias
                selectFamilias.setAttribute('multiple', 'multiple');
                selectFamilias.name = 'familias[]';
                fetchFamiliasAll();
            } else {
                // HIJO → mostrar solo las familias del padre
                selectFamilias.removeAttribute('multiple');
                selectFamilias.name = 'familia_id';

                fetch(`/users/${parentId}/familias`)
                    .then(res => res.json())
                    .then(data => {
                        selectFamilias.innerHTML = '';

                        data.forEach(familia => {
                            const option = document.createElement('option');
                            option.value = familia.id;
                            option.textContent =
                                `${familia.nombre} (${familia.ver_entre_hermanos ? '✓ puede ver entre hermanos' : '✗ no puede ver entre hermanos'})`;
                            selectFamilias.appendChild(option);
                        });
                    });
            }
        }

        // Renderizar todas las familias (para usuarios PADRES)
        function fetchFamiliasAll() {
            @if (isset($familias))
                const familiasAll = @json($familias);
                selectFamilias.innerHTML = '';
                familiasAll.forEach(familia => {
                    const option = document.createElement('option');
                    option.value = familia.id;
                    option.textContent =
                        `${familia.nombre} (${familia.ver_entre_hermanos ? '✓ puede ver entre hermanos' : '✗ no puede ver entre hermanos'})`;
                    selectFamilias.appendChild(option);
                });
            @endif
        }

        // Eventos
        document.addEventListener('DOMContentLoaded', actualizarFamiliaDinamica);
        checkboxSuperior.addEventListener('change', actualizarFamiliaDinamica);
        selectParent.addEventListener('change', actualizarFamiliaDinamica);
    </script>



@endsection
