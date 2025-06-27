<div>
    @can($permiso)
        <form action="{{ route($ruta, $modelo) }}" method="POST" class="form-eliminar d-inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="mdi mdi-delete"></i> Eliminar
            </button>
        </form>
    @endcan

</div>
