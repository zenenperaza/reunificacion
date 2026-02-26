@extends('layouts.app')
@section('title', 'Editar Donante')

@section('content')
<div class="page-content">
  <div class="container-fluid">
            <x-breadcrumb title="Editar Donante" />

        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('donantes.index') }}" class="btn btn-secondary">
                    <i class="mdi mdi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        </div>
    <div class="card">
      <div class="card-body">
        <h4 class="mb-3">Editar Donante</h4>

        <form method="POST" action="{{ route('donantes.update', $donante) }}">
          @method('PUT')
          @include('donantes._form', ['donante' => $donante])
        </form>
      </div>
    </div>
  </div>
</div>
@endsection