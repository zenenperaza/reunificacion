<div>
    @can($permiso)
        <a href="{{ route($ruta, $modelo) }}" class="btn btn-info btn-sm">
            <i class="mdi mdi-eye"></i> {{ $texto }}
        </a>
    @endcan

</div>
