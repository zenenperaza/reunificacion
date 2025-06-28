@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Informes de Casos</h2>
    <form method="GET" action="{{ route('informes.exportarExcel') }}">
        <div class="row">
            <div class="col-md-3">
                <label>Fecha Inicio</label>
                <input type="date" name="start_date" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Fecha Fin</label>
                <input type="date" name="end_date" class="form-control">
            </div>
            <div class="col-md-3">
                <label>Estado</label>
                <select name="estado_id" class="form-control">
                    <option value="">Todos</option>
                    <!-- Aquí lista de estados -->
                </select>
            </div>
            <div class="col-md-3">
                <label>Estatus</label>
                <select name="estatus" class="form-control">
                    <option value="">Todos</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Cierre de atención">Cierre de atención</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-3">Exportar a Excel</button>
    </form>
</div>
@endsection
