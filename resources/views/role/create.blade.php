@extends('layouts.app')

@section('title', 'Nuevo Rol')

@section('content')
<div class="container-fluid">
    <x-breadcrumb title="Nuevo Rol" />
    <div class="row">
        <div class="col-12">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Rol</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                   <div class="mb-3">
       <div class="card-body">
                <p class="text-muted">Selecciona los permisos que deseas asignar a este rol.</p>
            </div>

  <div class="row">
      <div class="form-check mb-2 d-flex justify-content-end">
        <input type="checkbox" class="form-check-input mx-1" id="select_all_permissions">
        <label class="form-check-label" for="select_all_permissions">Seleccionar todos</label>
    </div>
  </div>

    <div class="row">
        <div class="card">
        
        @foreach($permissions as $permiso)
            <div class="col-md-12 my-2">
                <div class="form-check">
                    <input type="checkbox" name="permissions[]" value="{{ $permiso->name }}" class="form-check-input permiso-checkbox" id="permiso_{{ $permiso->id }}">
                    <label class="form-check-label" for="permiso_{{ $permiso->id }}">{{ $permiso->name }}</label>
                </div>
            </div>
        @endforeach
        
        </div>
    </div>
</div>


                        <button class="btn btn-success">Guardar</button>
                        <a href="{{ route('role.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAll = document.getElementById('select_all_permissions');
        const checkboxes = document.querySelectorAll('.permiso-checkbox');

        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
        });
    });
</script>

@endsection
