@extends('layouts.app')

@section('title', 'Crear Caso')

@section('styles')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Registro de Caso</h4>
                <form action="{{ route('casos.store') }}" method="POST" enctype="multipart/form-data" id="formCaso">
        @csrf

                <div id="progressbarwizard">
                    <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                        <li class="nav-item">
                            <a href="#tab1" data-bs-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span class="d-none d-sm-inline">Información General</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab2" data-bs-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-clipboard-text me-1"></i>
                                <span class="d-none d-sm-inline">Detalles del Caso</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab3" data-bs-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                <i class="mdi mdi-upload me-1"></i>
                                <span class="d-none d-sm-inline">Adjuntos</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content b-0 mb-0 pt-0">
                        <div class="tab-pane active" id="tab1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="beneficiario" class="form-label">Beneficiario</label>
                                        <input type="text" class="form-control" name="beneficiario" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fecha_atencion" class="form-label">Fecha de Atención</label>
                                        <input type="date" class="form-control" name="fecha_atencion" required>
                                    </div>
                                </div>

                                <!-- Estado -> Municipio -> Parroquia -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Estado</label>
                                        <select class="form-control select2" name="estado_id" id="estadoSelect">
                                            <option value="">Seleccione</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Municipio</label>
                                        <select class="form-control select2" name="municipio_id" id="municipioSelect"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Parroquia</label>
                                        <select class="form-control select2" name="parroquia_id" id="parroquiaSelect"></select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Organización Solicitante</label>
                                        <select class="form-control select2" name="organizacion_solicitante">
                                            <option value="">Seleccione</option>
                                            @foreach ($organizaciones ?? [] as $opcion)
                                                <option value="{{ $opcion }}">{{ $opcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tipo de Atención / Programas</label>
                                        <select class="form-control select2" name="tipo_atencion_programas[]" multiple>
                                            @foreach ($tiposAtencion ?? [] as $opcion)
                                                <option value="{{ $opcion }}">{{ $opcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Servicio Brindado COSUDE</label>
                                        <select class="form-control select2" name="servicio_brindado_cosude[]" multiple>
                                            @foreach ($cosude ?? [] as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Servicio Brindado UNICEF</label>
                                        <select class="form-control select2" name="servicio_brindado_unicef[]" multiple>
                                            @foreach ($unicef ?? [] as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Vulnerabilidades</label>
                                        <select class="form-control select2" name="vulnerabilidades[]" multiple>
                                            @foreach ($vulnerabilidades ?? [] as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Derechos Vulnerados</label>
                                        <select class="form-control select2" name="derechos_vulnerados[]" multiple>
                                            @foreach ($derechos ?? [] as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">Imágenes</label>
                                    <div class="dropzone" id="dropzoneImages"></div>
                                </div>

                                <div class="col-12 mt-3">
                                    <label class="form-label">Archivos</label>
                                    <div class="dropzone" id="dropzoneFiles"></div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-inline mb-0 wizard">
                            <li class="previous list-inline-item">
                                <a href="javascript: void(0);" class="btn btn-secondary">Anterior</a>
                            </li>
                            <li class="next list-inline-item float-end">
                                <a href="javascript: void(0);" class="btn btn-secondary">Siguiente</a>
                            </li>
                            <li class="submit list-inline-item float-end">
                                <button type="submit" class="btn btn-primary">Guardar Caso</button>
                            </li>
                        </ul>
                    </div>
                </div>
                
    </form>
                
            </div>
        </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>

  <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
   <!-- Plugins js-->
        <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
<script>
    $('.select2').select2();

    $('#estadoSelect').change(function () {
        let estadoID = $(this).val();
        $('#municipioSelect').empty();
        $('#parroquiaSelect').empty();
        if (estadoID) {
            $.get(`/api/municipios/${estadoID}`, function(data) {
                $.each(data, function(key, municipio) {
                    $('#municipioSelect').append(`<option value="${municipio.id}">${municipio.nombre}</option>`);
                });
            });
        }
    });

    $('#municipioSelect').change(function () {
        let municipioID = $(this).val();
        $('#parroquiaSelect').empty();
        if (municipioID) {
            $.get(`/api/parroquias/${municipioID}`, function(data) {
                $.each(data, function(key, parroquia) {
                    $('#parroquiaSelect').append(`<option value="${parroquia.id}">${parroquia.nombre}</option>`);
                });
            });
        }
    });

    Dropzone.autoDiscover = false;
    let uploadedImages = [];
    let uploadedFiles = [];

    let dropzoneImages = new Dropzone("#dropzoneImages", {
        url: "{{ route('casos.upload.imagenes') }}",
        paramName: "imagenes[]",
        maxFilesize: 5,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        success: function(file, response) {
            uploadedImages.push(response);
        }
    });

    let dropzoneFiles = new Dropzone("#dropzoneFiles", {
        url: "{{ route('casos.upload.archivos') }}",
        paramName: "archivos[]",
        maxFilesize: 10,
        acceptedFiles: '.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar',
        addRemoveLinks: true,
        success: function(file, response) {
            uploadedFiles.push(response);
        }
    });

    document.getElementById("formCaso").addEventListener("submit", function(e) {
        let form = this;
        let inputImg = document.createElement('input');
        inputImg.type = 'hidden';
        inputImg.name = 'fotos';
        inputImg.value = JSON.stringify(uploadedImages);
        form.appendChild(inputImg);

        let inputFiles = document.createElement('input');
        inputFiles.type = 'hidden';
        inputFiles.name = 'archivos';
        inputFiles.value = JSON.stringify(uploadedFiles);
        form.appendChild(inputFiles);
    });
</script>

<script>
    $(document).ready(function () {
        let $tabs = $('#progressbarwizard .tab-pane');
        let $links = $('#progressbarwizard .nav-link');
        let currentIndex = 0;

        function showTab(index) {
            $tabs.removeClass('active show');
            $tabs.eq(index).addClass('active show');

            $links.removeClass('active');
            $links.eq(index).addClass('active');
        }

        $('.wizard .next').click(function () {
            if (currentIndex < $tabs.length - 1) {
                currentIndex++;
                showTab(currentIndex);
            }
        });

        $('.wizard .previous').click(function () {
            if (currentIndex > 0) {
                currentIndex--;
                showTab(currentIndex);
            }
        });

        showTab(currentIndex); // Inicializar
    });


    function updateProgressBar(index) {
    let percentage = ((index + 1) / $tabs.length) * 100;
    $('#bar .progress-bar').css('width', percentage + '%');
}

function showTab(index) {
    $tabs.removeClass('active show');
    $tabs.eq(index).addClass('active show');

    $links.removeClass('active');
    $links.eq(index).addClass('active');

    updateProgressBar(index);
}



</script>

@endsection




