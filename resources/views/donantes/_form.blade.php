@csrf

<div class="mb-3">
  <label class="form-label">Nombre</label>
  <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
         value="{{ old('nombre', $donante->nombre) }}" required>
  @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label class="form-label">Estatus</label>
  <select name="estatus" class="form-select">
    <option value="1" @selected(old('estatus', $donante->estatus ?? true) == 1)>Activo</option>
    <option value="0" @selected(old('estatus', $donante->estatus ?? true) == 0)>Inactivo</option>
  </select>
</div>

<hr>

<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Nombre del contacto</label>
    <input type="text" name="enlaces[nombre_contacto]" class="form-control"
           value="{{ old('enlaces.nombre_contacto', $donante->enlaces['nombre_contacto'] ?? '') }}">
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label">Teléfono</label>
    <input type="text" name="enlaces[telefono]" class="form-control"
           value="{{ old('enlaces.telefono', $donante->enlaces['telefono'] ?? '') }}">
  </div>
</div>

<div class="d-flex gap-2">
  <button class="btn btn-primary" type="submit">Guardar</button>
  <a class="btn btn-light" href="{{ route('donantes.index') }}">Cancelar</a>
</div>