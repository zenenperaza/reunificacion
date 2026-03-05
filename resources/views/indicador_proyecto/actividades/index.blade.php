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

    <x-breadcrumb title="Actividades del Indicador" icono="<i class='mdi mdi-clipboard-check-outline'></i>" />

    <div class="row mb-3">
        <div class="col-md-12 d-flex gap-2">
            <a href="{{ route('proyectos.indicadores.index', $indicadorProyecto->proyecto_id) }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Volver a indicadores del proyecto
            </a>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregar">
                <i class="mdi mdi-plus"></i> Agregar Actividad
            </button>
        </div>
    </div>

    <div class="alert alert-info">
        <div><strong>Proyecto:</strong> {{ $indicadorProyecto->proyecto->codigo ?? '-' }}</div>
        <div><strong>Indicador:</strong> {{ $indicadorProyecto->indicador->codigo ?? '-' }} - {{ $indicadorProyecto->indicador->descripcion ?? '' }}</div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="ai-table" class="table table-bordered w-100">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Meta</th>
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

            <form method="POST" action="{{ route('indicadorproyecto.actividades.store', $indicadorProyecto->id) }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Agregar Actividad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Actividad</label>
                        <select name="actividad_id" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @foreach($actividades as $a)
                                <option value="{{ $a->id }}">{{ $a->codigo }} - {{ $a->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Meta</label>
                        <input type="number" name="meta" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Guardar</button>
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
                    <h5 class="modal-title">Editar Meta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Meta</label>
                        <input type="number" id="edit_meta" class="form-control">
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
let tableAI;

function initAI(){
    tableAI = $('#ai-table').DataTable({
        processing:true,
        serverSide:true,
        ajax:{ url:"{{ route('indicadorproyecto.actividades.data',$indicadorProyecto->id) }}" },
        columns:[
            {data:'id'},
            {data:'codigo'},
            {data:'descripcion'},
            {data:'meta'},
            {data:'estatus_html', orderable:false, searchable:false},
            {data:'acciones', orderable:false, searchable:false},
        ],
        language:{ url:"{{ asset('assets/lang/datatables/es-ES.json') }}" },
        drawCallback: function(){
            document.querySelectorAll('.switch-ai').forEach(function(el){
                if(!el.dataset.switchery){
                    new Switchery(el,{ size:'small', color:'#039cfd' });
                }
            });
        }
    });
}

$(function(){ initAI(); });

// Editar meta
$(document).on('click','.btn-edit',function(){
    $('#edit_id').val($(this).data('id'));
    $('#edit_meta').val($(this).data('meta'));
    $('#modalEditar').modal('show');
});

$('#formEditar').on('submit',function(e){
    e.preventDefault();
    const id = $('#edit_id').val();

    $.ajax({
        url: "{{ url('actividad-indicador') }}/"+id,
        method: "PUT",
        data:{
            _token: $('meta[name="csrf-token"]').attr('content'),
            meta: $('#edit_meta').val()
        },
        success:function(){
            $('#modalEditar').modal('hide');
            tableAI.ajax.reload(null,false);
            Swal.fire({ icon:'success', title:'Actualizado', timer:1200, showConfirmButton:false });
        },
        error:function(){
            Swal.fire({ icon:'error', title:'Error', text:'No se pudo actualizar' });
        }
    });
});

// Toggle estatus
$(document).on('change','.switch-ai',function(){
    const checkbox = $(this);
    const id = checkbox.data('id');
    const label = checkbox.closest('td').find('.switch-label');

    checkbox.prop('disabled',true);

    $.ajax({
        url: "{{ url('actividad-indicador') }}/"+id+"/estatus",
        method: "POST",
        data:{ _token: $('meta[name="csrf-token"]').attr('content') },
        success:function(res){
            if(checkbox.is(':checked')){
                label.text('Activo').removeClass('text-danger').addClass('text-success');
            }else{
                label.text('Inactivo').removeClass('text-success').addClass('text-danger');
            }
        },
        error:function(){
            checkbox.prop('checked', !checkbox.prop('checked'));
            Swal.fire({ icon:'error', title:'Error', text:'No se pudo cambiar el estatus' });
            tableAI.ajax.reload(null,false);
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
        title:'¿Quitar actividad?',
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