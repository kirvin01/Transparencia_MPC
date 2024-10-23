<form action="{{ isset($directorio) ? route('datos-generales.directorio.update', $directorio) : route('datos-generales.directorio.store') }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf
    @if (isset($directorio))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="id_categoria">ID Categoría</label>
        <input type="text" name="id_categoria" class="form-control" value="{{ old('id_categoria', $directorio->id_categoria ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto">
        @if (isset($directorio) && $directorio->foto)
            <!-- Mostrar la imagen existente -->
            <div class="mt-2">
                <img src="{{ asset('storage/' . $directorio->foto) }}" alt="Foto actual" width="100">
            </div>
        @endif
    </div>

    <div class="form-group">
        <label for="cargo">Cargo</label>
        <input type="text" name="cargo" class="form-control" value="{{ old('cargo', $directorio->cargo ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $directorio->nombre ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos', $directorio->apellidos ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" name="correo" class="form-control" value="{{ old('correo', $directorio->correo ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $directorio->telefono ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        {{ isset($directorio) ? 'Actualizar' : 'Crear' }}
    </button>
</form>
