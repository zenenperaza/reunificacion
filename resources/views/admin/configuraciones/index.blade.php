@extends('layouts.app')

@section('title', 'Configuraciones del Sistema')

@section('styles')

    <link href="{{ asset('assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />

@endsection

@section('content')

    <div class="container-fluid mx-2">

        <x-breadcrumb title="Configuraciones" icono="<i class='fe-settings noti-icon' style='font-size: medium;'></i>" />

        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Cambiar fecha actual</h4>
                        <p class="sub-header">
                            Permite a los usuarios modificar la fecha actual
                        </p>

                        <div class="row">
                            <div class="col-lg-6">

                                <form action="{{ route('configuraciones.update') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Fecha actual</label>
                                        <div class="form-check mb-1">
                                            <input type="radio" name="conf_fecha_actual" id="fechaActualSi" value="si"
                                                required class="form-check-input">
                                            <label for="fechaActualSi" class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="conf_fecha_actual" id="fechaActualNo" value="no"
                                                class="form-check-input">
                                            <label for="fechaActualNo" class="form-check-label">No</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </form>



                            </div>

                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/mohithg-switchery/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-mockjax/jquery.mockjax.min.js') }}"></script>
    <script src="{{ asset('assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
