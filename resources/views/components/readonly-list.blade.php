@props(['label', 'items'])

<div class="mb-3">
    <label class="form-label fw-bold">{{ $label }}</label>
    @if (is_array($items) && count($items))
        <ul class="list-group">
            @foreach ($items as $item)
                <li class="list-group-item">{{ $item }}</li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">Sin datos registrados.</p>
    @endif
</div>
