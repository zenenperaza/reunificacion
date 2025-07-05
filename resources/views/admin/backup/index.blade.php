@extends('layouts.app')

@section('styles')

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">
    <h3 class="mb-4"><i class="uil uil-database"></i> Gestión de Backups</h3>

    {{-- Mensajes --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            {{-- Crear Backup --}}
            <form method="POST" action="{{ route('backup.create') }}" class="d-inline">
                @csrf
                <button class="btn btn-primary"><i class="uil uil-plus-circle"></i> Crear Backup</button>
            </form>

            {{-- Restaurar Backup --}}
            <form method="POST" action="{{ url('/admin/backup/restaurar') }}" enctype="multipart/form-data" class="row g-2 mt-3">
                @csrf
                <div class="col-md-6">
                    <label for="backup_file" class="form-label">Restaurar desde archivo (.zip)</label>
                    <input type="file" name="backup_file" class="form-control" required accept=".zip">
                </div>
                <div class="col-md-auto align-self-end">
                    <button type="submit" class="btn btn-warning mt-2"><i class="uil uil-upload-alt"></i> Restaurar Backup</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla de archivos --}}
    <div class="card">
        <div class="card-header">
            <strong>Listado de Archivos de Backup</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre del Archivo</th>
                            <th>Fecha</th>
                            <th>Tamaño</th>
                            <th class="text-center" style="width: 160px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($files as $file)
                            <tr>
                                <td>{{ $file['name'] }}</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp($file['modified'])->format('d/m/Y H:i') }}</td>
                                <td>{{ number_format($file['size'] / 1024, 2) }} KB</td>
                                <td class="text-center">
                                    <a href="{{ route('backup.download', $file['name']) }}" class="btn btn-success btn-sm">
                                        <i class="uil uil-import"></i> Descargar
                                    </a>

                                    <form method="POST" action="{{ route('backup.delete', $file['name']) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                       <button type="button" class="btn btn-danger btn-sm btn-delete" data-file="{{ route('backup.delete', $file['name']) }}">
    <i class="uil uil-trash-alt"></i> Eliminar
</button>

                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No hay archivos de respaldo disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const url = this.dataset.file;

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esto eliminará el archivo de respaldo permanentemente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const token = document.createElement('input');
                    token.type = 'hidden';
                    token.name = '_token';
                    token.value = '{{ csrf_token() }}';
                    form.appendChild(token);

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>

@endsection

