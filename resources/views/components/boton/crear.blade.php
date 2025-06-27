<div>
    @can($permiso)
        <a href="{{ route($ruta) }}" class="btn btn-primary">
            <i class="mdi mdi-plus"></i> {{ $texto }}
        </a>
    @endcan
</div>
