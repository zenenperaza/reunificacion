<div>
    @can($permiso)
        <a href="{{ route($ruta, $modelo) }}" class="btn btn-warning btn-sm">
            <i class="mdi mdi-pencil"></i> {{ $texto }}
        </a>
    @endcan
</div>
