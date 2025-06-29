@extends('layouts.app')

@section('title', 'Casos Eliminados')

@section('styles')

    <link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
<div class="container mt-4">
    <h4>Casos Eliminados</h4>
    <table id="eliminados-table" class="table table-bordered table-striped w-100"></table>
</div>
@endsection

@section('scripts')


@section('scripts')

    <!-- DataTables núcleo + Bootstrap 5 -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Responsive -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <!-- Botones -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- PDF y Excel -->
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>


<script>
    $(function () {
        let tabla = $('#eliminados-table').DataTable({
            processing: true,
            serverSide: true,
           ajax: '{{ route('casos.eliminados.data') }}',
            columns: [
                { data: 'id', title: 'ID' },
                { data: 'numero_caso', title: 'Número de Caso' },
                { data: 'fecha_atencion', title: 'Fecha de Atención' },
                { data: 'acciones', title: 'Acciones', orderable: false, searchable: false }
            ],
                language: {
                url: "{{ asset('assets/lang/datatables/es-ES.json') }}"
            },
        });

         $(document).on('click', '.btn-restore', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '/casos/' + id + '/restaurar',
            type: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Caso restaurado correctamente',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire('Error', xhr.responseJSON?.message || 'No se pudo restaurar el caso.', 'error');
            }
        });
    });
    });
</script>
@endsection
