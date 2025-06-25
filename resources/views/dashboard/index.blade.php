@extends('layouts.app')

@section('title', 'Dashboard RLF')

@section('content')
    <div class="content mt-4">
        <div class="container-fluid">

            <div class="row">
                {{-- Total de Casos --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Casos Totales</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f05050"
                                        data-bgColor="#F9B9B9" value="{{ $totales['casos'] }}" data-max="10000"
                                         data-skin="tron" data-angleOffset="180" data-readOnly="true"
                                        data-thickness=".15" />

                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1">{{ $totales['casos'] }}</h2>
                                    <p class="text-muted mb-1">Total registrados</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Masculino --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Beneficiarios Masculinos</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#4fc6e1"
                                        data-bgColor="#cceeff" value="{{ $totales['masculino'] }}" data-max="10000" data-skin="tron"
                                        data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1">{{ $totales['masculino'] }}</h2>
                                    <p class="text-muted mb-1">Masculino</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Femenino --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Beneficiarias Femeninas</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f78fb3"
                                        data-bgColor="#fddde6" value="{{ $totales['femenino'] }}" data-max="10000" data-skin="tron"
                                        data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1">{{ $totales['femenino'] }}</h2>
                                    <p class="text-muted mb-1">Femenino</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Casos este mes --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Casos este mes</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#1abc9c"
                                        data-bgColor="#bfffe0" value="{{ $totales['mes_actual'] }}" data-max="10000" data-skin="tron"
                                        data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1">{{ $totales['mes_actual'] }}</h2>
                                    <p class="text-muted mb-1">Registrados este mes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Puedes agregar aquí gráficos, tablas, widgets, etc. --}}

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">Exportar</a>
                                    <a href="javascript:void(0);" class="dropdown-item">Recargar</a>
                                </div>
                            </div>
                            <h4 class="header-title mt-0">Casos en los últimos 6 meses</h4>
                            <div id="morris-bar-casos-mes" style="height: 280px;" class="morris-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-3">Distribución por Tipo de Beneficiario</h4>
                            <div id="donut-beneficiario-container" class="flot-chart" style="height: 260px;"></div>

                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    </div>



@endsection

@section('scripts')


    <script src="{{ asset('assets/libs/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/libs/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/libs/morris.js06/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

    <script>
        new Morris.Bar({
            element: 'morris-bar-casos-mes',
            data: {!! json_encode(
                $ultimosMeses->map(
                    fn($m) => [
                        'mes' => $m['mes'],
                        'total' => $m['total'],
                    ],
                ),
            ) !!},
            xkey: 'mes',
            ykeys: ['total'],
            labels: ['Casos'],
            barColors: ['#6658dd'],
            hideHover: 'auto',
            resize: true
        });
    </script>

    <script>
        $(function() {
            const total = {{ $porBeneficiario->sum() }};

            var beneficiarioData = [
                @foreach ($porBeneficiario as $tipo => $cantidad)
                    {
                        label: "{{ $tipo }} ({{ round(($cantidad / $porBeneficiario->sum()) * 100) }}%, {{ $cantidad }} casos)",
                        data: {{ $cantidad }},
                        color: getRandomColor()
                    },
                @endforeach
            ];

            $.plot('#donut-beneficiario-container', beneficiarioData, {
                series: {
                    pie: {
                        show: true,
                        innerRadius: 0.7,
                        label: {
                            show: false // Ocultar labels dentro de la dona
                        }
                    }
                },
                legend: {
                    show: true
                }
            });

            function getRandomColor() {
                const colors = ['#42a5f5', '#f06292', '#66bb6a', '#ffa726', '#ab47bc', '#26c6da'];
                return colors[Math.floor(Math.random() * colors.length)];
            }
        });
    </script>



<script>
    $(window).on('load', function () {
        $('[data-plugin="knob"]').each(function () {
            const $knob = $(this);
            const valorActual = parseInt($knob.attr('value')) || 0;

            // Establece un data-max dinámico si no existe
            const max = Math.ceil((valorActual + 1) / 1000) * 1000;
            $knob.attr('data-max', max);

            // Asegúrate de que se inicialice después de configurar el data-max
            $knob.knob();
        });
    });
</script>


@endsection
