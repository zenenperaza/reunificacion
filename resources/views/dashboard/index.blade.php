@extends('layouts.app')

@section('title', 'Dashboard RLF')

@section('styles')
    <style>
        #mapa-venezuela-casos text {
            font-size: 10px !important;
        }

        .table-sm td,
        .table-sm th {
            padding: 0.2rem 0.3rem;
        }
    </style>


@endsection

@section('content')
    <div class="content mt-4 mx-2">
        <div class="container-fluid">
            <x-breadcrumb title="Dashboard" icono="<i class='mdi mdi-view-dashboard-outline'></i>" />

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
                                        data-skin="tron" data-angleOffset="180" data-readOnly="true" data-thickness=".15" />

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
                                    <input 
    data-plugin="knob"
    data-width="70"
    data-height="70"
    data-fgColor="#4fc6e1"
    data-bgColor="#e0f7fa"
    value="{{ $totales['masculino_pct'] }}"
    data-max="100"
    data-skin="tron"
    data-angleOffset="180"
    data-readOnly="true"
    data-thickness=".2"
    data-displayInput="true"
/>


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
                                        data-bgColor="#fce4ec" value="{{ $totales['femenino_pct'] }}" data-max="100"
                                        data-skin="tron" data-angleOffset="180" data-readOnly="true" data-thickness=".2"
                                        data-displayInput="true" data-displayPrevious="true" data-font="inherit"
                                        data-format="percentage" />

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
                                        data-bgColor="#bfffe0" value="{{ $totales['mes_actual'] }}" data-max="10000"
                                        data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
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
            {{-- <div class="text-center mb-3">
                <h5>Total general de casos destino:
                    <span class="badge bg-primary">
                        {{ $mapaEstados->sum() }} casos
                    </span>
                </h5>
            </div> --}}
            <div class="row  flex-row bg-white p-3 rounded mx-1">
                {{-- Mapa a la izquierda --}}
                <div class="col-md-8">
                    <div class=" h-100">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Casos por Estado de Destino</h4>
                            <div id="mapa-venezuela-casos" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>

                {{-- Chart a la derecha --}}
                <div class="col-md-4">
                    <div class=" h-100">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Top 5 Estados Destino</h4>
                            <canvas id="bar-top-estados" height="250"></canvas>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Highcharts Map --}}
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/mapdata/countries/ve/ve-all.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>



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
      $(function () {
    $('[data-plugin="knob"]').each(function () {
        var $this = $(this);
        var val = parseFloat($this.val()) || 0;

        // Establece data-max si no está
        if (!$this.attr('data-max')) {
            $this.attr('data-max', 100);
        }

        $this.knob({
            draw: function () {
                // Sobrescribe el valor con símbolo %
                if (this.$.data('displayInput') && this.$.is(':visible')) {
                    this.$.val(this.cv + '%');
                }
            }
        });
    });
});

    </script>



    <script>
        Highcharts.mapChart('mapa-venezuela-casos', {
            chart: {
                map: 'countries/ve/ve-all',
                backgroundColor: '#fff',
                spacingBottom: 20
            },

            title: {
                text: 'Casos por Estado de Destino',
                style: {
                    fontSize: '18px',
                    fontWeight: '600',
                    color: '#2c3e50'
                }
            },

            tooltip: {
                useHTML: true,
                backgroundColor: '#ffffff',
                borderColor: '#3498db',
                borderRadius: 8,
                shadow: true,
                style: {
                    fontSize: '13px',
                    color: '#2c3e50'
                },
                pointFormat: '<b>{point.name}</b><br>Casos destino: <span style="color:#3498db">{point.value}</span>'
            },

            colorAxis: {
                min: 0,
                minColor: '#e0f7fa',
                maxColor: '#007acc'
            },

            series: [{
                data: [
                    @foreach ($mapaEstados as $codigo => $cantidad)
                        ['{{ $codigo }}', {{ $cantidad }}],
                    @endforeach
                ],
                name: 'Casos',
                states: {
                    hover: {
                        color: '#ffa726'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name} {point.value}',
                    style: {
                        fontSize: '11px',
                        fontWeight: 'normal',
                        color: '#2c3e50',
                        textOutline: 'none'
                    }
                }
            }]
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('bar-top-estados').getContext('2d');

            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($topEstados as $estado)
                            "{{ $estado->nombre }}",
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Casos destino',
                        data: [
                            @foreach ($topEstados as $estado)
                                {{ $estado->total }},
                            @endforeach
                        ],
                        backgroundColor: ['#f1c40f', '#e67e22', '#e74c3c', '#8e44ad', '#3498db'],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return ` ${context.raw} casos`;
                                }
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'right',
                            color: '#34495e',
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            formatter: function(value) {
                                return value;
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]

            });
        });
    </script>



@endsection
