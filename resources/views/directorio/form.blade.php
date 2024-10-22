<div class="container">
    <h1>{{ isset($directorio) ? 'Editar Directorio' : 'Crear Directorio' }}</h1>
    <form
        action="{{ isset($directorio) ? route('datos-generales.directorio.update', $directorio) : route('datos-generales.directorio.store') }}"
        method="POST">
        @csrf
        @if (isset($directorio))
            @method('PUT')
        @endif

        <!-- Campo de ID de Categoría -->
        <div class="form-group">
            <label for="id_categoria">ID Categoría</label>
            <input type="text" name="id_categoria" class="form-control"
                value="{{ old('id_categoria', $directorio->id_categoria ?? '') }}" required>
        </div>

        <!-- Campo de Foto -->
        <div class="form-group">
            <label for="foto">Ruta de la Foto</label>
            <input type="text" name="foto" class="form-control" value="{{ old('foto', $directorio->foto ?? '') }}"
                required>
        </div>

        <!-- Campo de Cargo -->
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" name="cargo" class="form-control"
                value="{{ old('cargo', $directorio->cargo ?? '') }}" required>
        </div>

        <!-- Campo de Nombre -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control"
                value="{{ old('nombre', $directorio->nombre ?? '') }}" required>
        </div>

        <!-- Campo de Apellidos -->
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" class="form-control"
                value="{{ old('apellidos', $directorio->apellidos ?? '') }}" required>
        </div>

        <!-- Campo de Correo -->
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" class="form-control"
                value="{{ old('correo', $directorio->correo ?? '') }}" required>
        </div>

        <!-- Campo de Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                value="{{ old('telefono', $directorio->telefono ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($directorio) ? 'Actualizar' : 'Crear' }}
        </button>
    </form>
</div>
