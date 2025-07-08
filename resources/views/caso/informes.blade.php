@extends('layouts.app')

@section('title', 'Mantenimiento de Casos')

@section('styles')

    <link href="{{ asset('assets/libs/daterangepicker/daterangepicker.css') }}" rel="stylesheet">


@endsection

@section('content')
    <div class="container-fluid">
        <x-breadcrumb title="Informes" icono="<i class='mdi mdi-clipboard-text-outline me-1'></i>" />

        <div class="row mb-3  d-flex my-2 justify-content-between">

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Informes</h4>


                    <form action="{{ route('casos.informes') }}" method="GET" class="mb-3">
                        <div class="row">
                            {{-- Filtros como antes --}}
                            <div class="col-md-3">
                                <label>Desde:</label>
                                <input type="date" name="start" value="{{ request('start') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Hasta:</label>
                                <input type="date" name="end" value="{{ request('end') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Estado:</label>
                                <select name="estado_id" class="form-control">
                                    <option value="">Todos</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}"
                                            {{ request('estado_id') == $estado->id ? 'selected' : '' }}>
                                            {{ $estado->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Estatus:</label>
                                <select name="estatus" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="pendiente" {{ request('estatus') == 'pendiente' ? 'selected' : '' }}>
                                        Pendiente</option>
                                    <option value="cerrado" {{ request('estatus') == 'cerrado' ? 'selected' : '' }}>Cerrado
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label>Búsqueda:</label>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Beneficiario, N° caso...">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label>Estado completado:</label>
                                <select name="estadoCompletado" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="completo"
                                        {{ request('estadoCompletado') == 'completo' ? 'selected' : '' }}>Completos
                                    </option>
                                    <option value="incompleto"
                                        {{ request('estadoCompletado') == 'incompleto' ? 'selected' : '' }}>Incompletos
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label>Condición:</label>
                                <select name="condicion" class="form-control">
                                    <option value="">Todas</option>
                                    <option value="aprobado" {{ request('condicion') == 'aprobado' ? 'selected' : '' }}>
                                        Aprobado</option>
                                    <option value="no_aprobado"
                                        {{ request('condicion') == 'no_aprobado' ? 'selected' : '' }}>No aprobado</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-2 mt-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="usarIA" name="usarIA"
                                        value="1" {{ request('usarIA') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="usarIA">
                                        <i class="mdi mdi-robot"></i> Incluir análisis generado por IA
                                    </label>
                                </div>
                            </div>


                            <div class="col-md-2 d-flex align-items-end mt-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="mdi mdi-magnify"></i> Buscar
                                </button>
                            </div>

                            <div class="col-md-2 d-flex align-items-end mt-2">
                                <a href="{{ route('casos.informes.export', request()->query()) }}"
                                    class="btn btn-success w-100">
                                    <i class="mdi mdi-file-excel"></i> Exportar Excel
                                </a>
                            </div>

                        </div>
                    </form>




                </div>
            </div>

            <div class="card">
                @if ($porEstatus->count() || $porEstado->count() || $porTipoAtencion->count())
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <canvas id="graficoEstatus"></canvas>
                        </div>
                        <div class="col-md-4">
                            <canvas id="graficoEstado"></canvas>
                        </div>
                        <div class="col-md-4">
                            <canvas id="graficoTipo"></canvas>
                        </div>
                    </div>
                @endif

            </div>
            @if (!empty($resumenLocal))
                <div class="alert alert-info mt-3">
                    <h5><i class="mdi mdi-chart-bar"></i> Resumen Estadístico</h5>
                    <p>{{ $resumenLocal }}</p>
                </div>
            @endif


            <div class="card">
                @if (!empty($informeIA))
                    <div class="card mt-4">
                        <div class="card-header bg-light">
                            <strong><i class="mdi mdi-robot"></i> Informe generado por IA</strong>
                        </div>
                        <div class="card-body">
                            <p style="white-space: pre-line;">{{ $informeIA }}</p>
                        </div>
                    </div>
                @endif

            </div>
            <div class="card">
                @if ($resumenLocal || $informeIA)
                    <form action="{{ route('casos.informes.pdf') }}" method="GET" target="_blank">
                        <input type="hidden" name="resumen" value="{{ $resumenLocal }}">
                        <input type="hidden" name="informe" value="{{ $informeIA }}">
                        <button class="btn btn-outline-danger mt-3">
                            <i class="mdi mdi-file-pdf"></i> Descargar informe PDF
                        </button>
                    </form>
                @endif

            </div>

        </div>
    </div>

@endsection

@section('scripts')

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- Moment y Rango de Fechas -->
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/libs/daterangepicker/daterangepicker.js') }}"></script>\



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = {
            estatus: @json($porEstatus),
            estado: @json($porEstado),
            tipo: @json($porTipoAtencion)
        };

        const renderChart = (ctxId, data) => {
            const ctx = document.getElementById(ctxId).getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        data: Object.values(data),
                        backgroundColor: ['#3bafda', '#f76397', '#1abc9c', '#f7b84b', '#6c757d']
                    }]
                }
            });
        };

        renderChart('graficoEstatus', chartData.estatus);
        renderChart('graficoEstado', chartData.estado);
        renderChart('graficoTipo', chartData.tipo);
    </script>



@endsection
