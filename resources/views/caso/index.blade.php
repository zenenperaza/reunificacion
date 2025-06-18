@extends('layouts.app')

@section('title', 'Mantenimiento de Casos')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-sm-12">
            <a href="{{ route('casos.create') }}" class="btn btn-success">
                <i class="mdi mdi-plus"></i> Nuevo Caso
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Lista de Casos</h4>
            <div class="table-responsive">
                <table id="casos-table" class="table table-bordered dt-responsive nowrap w-100">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>N° Caso</th>
                            <th>Beneficiario</th>
                            <th>Tipo Atención</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Municipio</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteCasoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form id="deleteCasoForm" method="POST">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteCasoModalLabel">¿Eliminar caso?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <p>¿Estás seguro que deseas eliminar el caso <strong id="casoIdModal"></strong>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<!-- DataTables scripts -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

<script>
$('#casos-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("casos.data") }}',
    columns: [
        { data: 'id', name: 'id' },
        { data: 'numero_caso', name: 'numero_caso' },
        { data: 'beneficiario', name: 'beneficiario' },
        { data: 'tipo_atencion', name: 'tipo_atencion' },
        { data: 'fecha_atencion', name: 'fecha_atencion' },
        { data: 'estado.nombre', name: 'estado.nombre' },
        { data: 'municipio.nombre', name: 'municipio.nombre' },
        { data: 'estatus', name: 'estatus' },
        { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
    ],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json'
    }
});
</script>

<script>
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var casoId = button.data('caso-id');

    var modal = $(this);
    modal.find('#casoIdModal').text(casoId);
    modal.find('#deleteCasoForm').attr('action', '/casos/' + casoId);
});
</script>

@if(session('success'))
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>
@endif
@endsection
