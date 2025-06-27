@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('styles')

    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" />

@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Perfil</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', auth()->user()->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ $errors->has('email') ? '' : old('email', auth()->user()->email) }}" required>

                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', auth()->user()->phone) }}">
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" name="address" class="form-control"
                        value="{{ old('address', auth()->user()->address) }}">
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Nueva contraseña (opcional)</label>
                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="mt-3">
                        <input type="file" name="photo" id="photo" data-plugins="dropify"
                            data-default-file="{{ asset('storage/' . $user->photo) }}" />
                        <p class="text-muted text-center mt-2 mb-0">Foto</p>
                    </div>
                </div>
            </div>

            <hr>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>

@endsection
