@props(['label', 'value'])

<div class="col-md-6 mb-3">
    <label class="form-label">{{ $label }}</label>
    <input type="text" class="form-control" value="{{ $value }}" disabled>
</div>
