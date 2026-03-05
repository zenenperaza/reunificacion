@extends('layouts.app')

@section('styles')
<link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

    <x-breadcrumb title="Servicios de la Actividad" icono="<i class='mdi mdi-briefcase-outline'></i>" />

    <div class="row mb-3">
        <div class="col-md-12 d-flex gap-2">

            <a href="{{ route('indicadorproyecto.actividades.index', $actividadIndicador->indicador_proyecto_id) }}"
               class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a actividades
            </a>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                <i class="mdi mdi-plus"></i> Agregar Servicio
            </button>

        </div>
    </div>

    <div class="alert alert-info">
        <div><strong>Proyecto:</strong> {{ $actividadIndicador->indicadorProyecto->proyecto->codigo ?? '-' }}</div>
        <div><strong>Indicador:</strong> {{ $actividadIndicador->indicadorProyecto->indicador->codigo ?? '-' }} - {{ $actividadIndicador->indicadorProyecto->indicador->descripcion ?? '' }}</div>
        <div><strong>Actividad:</strong> {{ $actividadIndicador->actividad->codigo ?? '-' }} - {{ $actividadIndicador->actividad->descripcion ?? '' }}</div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="sa-table" class="table table-bordered w-100">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Servicio</th>
                    <th>Cantidad disponible</th>
                    <th>Estatus</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

</div>


{{-- MODAL AGREGAR --}}
<div class="modal fade" id="modalAgregar">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('actividadindicador.servicios.store', $actividadIndicador->id) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Agregar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Servicio</label>
                        <select name="servicio_id" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @foreach($servicios as $s)
                                <option value="{{ $s->id }}">{{ $s->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cantidad disponible</label>
                        <input type="number" name="cantidad_disponible" class="form-control" value="0" min="0">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- MODAL EDITAR CANTIDAD --}}
<div class="modal fade" id="modalEditar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditar">
                @csrf
                @method('PUT')

                <input type="hidden" id="edit_id">

                <div class="modal-header">
                    <h5 class="modal-title">Editar Cantidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Cantidad disponible</label>
                        <input type="number" id="edit_cantidad" class="form-control" min="0">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Actualizar</button>
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

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>

<script>
let tableSA;

function initSA(){
    tableSA = $('#sa-table').DataTable({
        processing:true,
        serverSide:true,
        ajax:{ url:"{{ route('actividadindicador.servicios.data',$actividadIndicador->id) }}" },
        columns:[
            {data:'id'},
            {data:'descripcion'},
            {data:'cantidad_disponible'},
            {data:'estatus_html', orderable:false, searchable:false},
            {data:'acciones', orderable:false, searchable:false},
        ],
        language:{ url:"{{ asset('assets/lang/datatables/es-ES.json') }}" },
        drawCallback: function(){
            document.querySelectorAll('.switch-sa').forEach(function(el){
                if(!el.dataset.switchery){
                    new Switchery(el,{ size:'small', color:'#039cfd' });
                }
            });
        }
    });
}

$(function(){ initSA(); });

// Editar cantidad
$(document).on('click','.btn-edit',function(){
    $('#edit_id').val($(this).data('id'));
    $('#edit_cantidad').val($(this).data('cantidad'));
    $('#modalEditar').modal('show');
});

$('#formEditar').on('submit',function(e){
    e.preventDefault();
    const id = $('#edit_id').val();

    $.ajax({
        url: "{{ url('servicio-actividad') }}/"+id,
        method: "PUT",
        data:{
            _token: $('meta[name="csrf-token"]').attr('content'),
            cantidad_disponible: $('#edit_cantidad').val()
        },
        success:function(){
            $('#modalEditar').modal('hide');
            tableSA.ajax.reload(null,false);
            Swal.fire({ icon:'success', title:'Actualizado', timer:1200, showConfirmButton:false });
        },
        error:function(){
            Swal.fire({ icon:'error', title:'Error', text:'No se pudo actualizar' });
        }
    });
});

// Toggle estatus
$(document).on('change','.switch-sa',function(){
    const checkbox = $(this);
    const id = checkbox.data('id');
    const label = checkbox.closest('td').find('.switch-label');

    checkbox.prop('disabled',true);

    $.ajax({
        url: "{{ url('servicio-actividad') }}/"+id+"/estatus",
        method: "POST",
        data:{ _token: $('meta[name="csrf-token"]').attr('content') },
        success:function(){
            if(checkbox.is(':checked')){
                label.text('Activo').removeClass('text-danger').addClass('text-success');
            }else{
                label.text('Inactivo').removeClass('text-success').addClass('text-danger');
            }
        },
        error:function(){
            checkbox.prop('checked', !checkbox.prop('checked'));
            Swal.fire({ icon:'error', title:'Error', text:'No se pudo cambiar el estatus' });
            tableSA.ajax.reload(null,false);
        },
        complete:function(){
            checkbox.prop('disabled',false);
        }
    });
});

// Delete
$(document).on('click','.btn-delete',function(){
    const url = $(this).data('url');
    const nombre = $(this).data('nombre');

    Swal.fire({
        title:'¿Quitar servicio?',
        text:`Se quitará: ${nombre}`,
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Sí, quitar',
        cancelButtonText:'Cancelar',
        confirmButtonColor:'#d33'
    }).then((result)=>{
        if(result.isConfirmed){
            const form = $('<form>', { method:'POST', action:url });
            form.append($('<input>', { type:'hidden', name:'_token', value:$('meta[name="csrf-token"]').attr('content') }));
            form.append($('<input>', { type:'hidden', name:'_method', value:'DELETE' }));
            $('body').append(form);
            form.submit();
        }
    });
});
</script>
@endsection