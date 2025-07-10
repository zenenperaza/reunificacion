@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('familias.create') }}" class="btn btn-primary mb-3">Nueva Familia</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ver entre hermanos</th>
                <th>Usuarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familias as $familia)
                <tr>
                    <td>{{ $familia->nombre }}</td>
                    <td>{{ $familia->ver_entre_hermanos ? 'Sí' : 'No' }}</td>
                    <td>{{ $familia->usuarios_count }}</td>
                    <td>
                        <a href="{{ route('familias.edit', $familia) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('familias.destroy', $familia) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar esta familia?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
