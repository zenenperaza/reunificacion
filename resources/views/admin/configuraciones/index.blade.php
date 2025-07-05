@extends('layouts.app')

@section('title', 'Configuraciones del Sistema')

@section('content')
<div class="container-fluid">
    <h4 class="mb-3">⚙️ Configuraciones del Sistema</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Clave</th>
                        <th>Valor</th>
                        <th>Descripción</th>
                        <th width="150">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($configuraciones as $config)
                        <tr>
                            <td><strong>{{ $config->clave }}</strong></td>
                            <td>
                                <form method="POST" action="{{ route('configuraciones.update', $config) }}">
                                    @csrf
                                    <input type="text" name="valor" value="{{ $config->valor }}" class="form-control form-control-sm" required>
                            </td>
                            <td>{{ $config->descripcion }}</td>
                            <td>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="mdi mdi-check"></i> Guardar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
