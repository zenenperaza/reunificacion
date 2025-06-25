@props(['label', 'files' => [], 'type' => 'file']) {{-- type: 'image' o 'file' --}}

<div class="mb-3">
    <label class="form-label fw-bold">{{ $label }}</label>
    
    @if (is_array($files) && count($files))
        <div class="row">
            @foreach ($files as $file)
                <div class="col-md-3 mb-2">
                    @if ($type === 'image')
                        <a href="{{ asset('storage/' . $file) }}" target="_blank">
                            <img src="{{ asset('storage/' . $file) }}" class="img-fluid rounded border" alt="imagen">
                        </a>
                    @else
                        <a href="{{ asset('storage/' . $file) }}" target="_blank" class="d-block text-truncate">
                            <i class="mdi mdi-file-document"></i> {{ basename($file) }}
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Sin archivos cargados.</p>
    @endif
</div>
