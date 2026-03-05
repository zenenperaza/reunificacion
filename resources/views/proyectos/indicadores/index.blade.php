@extends('layouts.app')

@section('styles')
    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- si quieres tu mismo estilo --}}
    <link href="{{ asset('assets/css/casos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/proyectos.css') }}" rel="stylesheet">
@endsection


@section('content')
    <div class="container-fluid">

        <x-breadcrumb title="Indicadores del Proyecto" icono="<i class='mdi mdi-chart-line'></i>" />

        <div class="row mb-3">
            <div class="col-md-12">

                <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Volver a proyectos
                </a>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                    <i class="mdi mdi-plus"></i> Agregar Indicador
                </button>

            </div>
        </div>


        <div class="card">
            <div class="card-body">

                <table id="indicadores-proyecto-table" class="table table-bordered w-100">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Meta Cuantitativa</th>
                            <th>Meta Cualitativa</th>
                            <th>Estatus</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>

                </table>

            </div>
        </div>

    </div>



    {{-- MODAL AGREGAR INDICADOR --}}
    <div class="modal fade" id="modalAgregar">

        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="{{ route('proyectos.indicadores.store', $proyecto->id) }}">

                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Agregar Indicador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label>Indicador</label>

                            <select name="indicador_id" class="form-control" required>

                                <option value="">Seleccione...</option>

                                @foreach ($indicadores as $i)
                                    <option value="{{ $i->id }}">
                                        {{ $i->codigo }} - {{ $i->descripcion }}
                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <div class="mb-3">
                            <label>Meta Cuantitativa</label>
                            <input type="number" name="meta_cuantitativa" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Meta Cualitativa</label>
                            <input type="text" name="meta_cualitativa" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-success">
                            Guardar
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>




    {{-- MODAL EDITAR META --}}
    <div class="modal fade" id="modalEditar">

        <div class="modal-dialog">
            <div class="modal-content">

                <form id="formEditar">

                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit_id">

                    <div class="modal-header">
                        <h5 class="modal-title">Editar Metas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Meta Cuantitativa</label>
                            <input type="number" id="edit_meta_cuantitativa" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Meta Cualitativa</label>
                            <input type="text" id="edit_meta_cualitativa" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="submit" class="btn btn-success">
                            Actualizar
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>



    <script>
        let tablaIndicadores;

        function initTabla() {

            tablaIndicadores = $('#indicadores-proyecto-table').DataTable({

                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('proyectos.indicadores.data', $proyecto->id) }}"
                },

                columns: [

                    {
                        data: 'id'
                    },

                    {
                        data: 'codigo'
                    },

                    {
                        data: 'descripcion'
                    },

                    {
                        data: 'meta_cuantitativa'
                    },

                    {
                        data: 'meta_cualitativa'
                    },

                    {
                        data: 'estatus_html',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'acciones',
                        orderable: false,
                        searchable: false
                    }

                ],
                drawCallback: function() {
                    document.querySelectorAll('.switch-ip').forEach(function(el) {
                        if (!el.dataset.switchery) {
                            new Switchery(el, {
                                color: '#039cfd',
                                size: 'small'
                            });
                        }
                    });
                },

                language: {
                    url: "{{ asset('assets/lang/datatables/es-ES.json') }}"
                }

            });

        }



        $(function() {
            initTabla();
        });



        /*
        ===========================
        EDITAR METAS
        ===========================
        */

        $(document).on('click', '.btn-edit', function() {

            $('#edit_id').val($(this).data('id'));

            $('#edit_meta_cuantitativa').val($(this).data('meta_cuantitativa'));

            $('#edit_meta_cualitativa').val($(this).data('meta_cualitativa'));

            $('#modalEditar').modal('show');

        });



        $('#formEditar').submit(function(e) {

            e.preventDefault();

            let id = $('#edit_id').val();

            $.ajax({

                url: "/indicador-proyecto/" + id,

                method: "PUT",

                data: {
                    _token: "{{ csrf_token() }}",
                    meta_cuantitativa: $('#edit_meta_cuantitativa').val(),
                    meta_cualitativa: $('#edit_meta_cualitativa').val()
                },

                success: function() {

                    $('#modalEditar').modal('hide');

                    tablaIndicadores.ajax.reload();

                }

            });

        });



        /*
        ===========================
        CAMBIAR ESTATUS
        ===========================
        */

        $(document).on('change', '.switch-ip', function() {

            let id = $(this).data('id');

            $.post("/indicador-proyecto/" + id + "/estatus", {

                _token: "{{ csrf_token() }}"

            }, function() {

                tablaIndicadores.ajax.reload();

            });

        });



        /*
        ===========================
        ELIMINAR
        ===========================
        */

        $(document).on('click', '.btn-delete', function() {

            let url = $(this).data('url');

            let nombre = $(this).data('nombre');

            Swal.fire({

                title: '¿Eliminar indicador?',
                text: nombre,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar'

            }).then((result) => {

                if (result.isConfirmed) {

                    let form = $('<form>', {
                        method: 'POST',
                        action: url
                    });

                    form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
                    form.append('<input type="hidden" name="_method" value="DELETE">');

                    $('body').append(form);
                    form.submit();

                }

            });

        });
    </script>
@endsection
