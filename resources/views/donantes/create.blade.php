@extends('layouts.app')
@section('title', 'Nuevo Donante')

@section('content')
<div class="page-content">
  <div class="container-fluid">
     <x-breadcrumb title="Crear Caso" />

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('donantes.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        </div>
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3">Nuevo Donante</h4>

        <form method="POST" action="{{ route('donantes.store') }}">
          @include('donantes._form', ['donante' => $donante])
        </form>
      </div>
    </div>
  </div>
</div>
@endsection