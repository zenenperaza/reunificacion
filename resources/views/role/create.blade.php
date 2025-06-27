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
                            <label class="form-label">Permisos</label>
                            <div class="row">
                                @foreach($permissions as $permiso)
                                    <div class="col-md-12 my-2">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" value="{{ $permiso->name }}" class="form-check-input" id="permiso_{{ $permiso->id }}">
                                            <label class="form-check-label" for="permiso_{{ $permiso->id }}">{{ $permiso->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
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
